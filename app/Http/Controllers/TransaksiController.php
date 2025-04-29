<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use App\Constants\MetodePembayaran;
use App\Constants\StatusPembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Mutasi;
use App\Models\Keranjang;
use App\Models\Pesanan;

use App\Constants\StatusTransaksi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{

    public function store(Request $request) {
        $request->validate([
            'metode_pembayaran' => ['required', Rule::enum(MetodePembayaran::class)],
            'pesanan_dipilih' => 'required|string'  // Menambahkan validasi untuk memastikan ini string
        ]);

        $pesanan_dipilih = $request->input('pesanan_dipilih');
        $pesanan_dipilih = explode(',', $pesanan_dipilih);

        $keranjang = Keranjang::where('id_user', Auth::id())->first();

        $transaksi = Transaksi::create([
            'id_user' => Auth::id(),
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);

        // Update pesanan terkait
        Pesanan::whereIn('id', $pesanan_dipilih)
            ->where('id_keranjang', $keranjang->id)
            ->update([
                'id_transaksi' => $transaksi->id,
                'id_keranjang' => null
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan pemesanan barang',
            'transaksi' => $transaksi
        ], 200);
    }

    public function buktiPembayaran(Request $request, $id) {
        $request->validate([
            'bukti_pembayaran' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        $transaksi = Transaksi::findOrFail($id);

        if ($request->hasFile('bukti_pembayaran')) {
            // hapus file lama
            if($transaksi->bukti_pembayaran && Storage::disk('public')->exists($transaksi->bukti_pembayaran)) {
                Storage::disk('public')->delete($transaksi->bukti_pembayaran);
            }

            // simpan file baru
            $data['bukti_pembayaran'] = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');
        }

        $transaksi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil mengirim bukti pembayaran',
            'data' => $transaksi
        ], 200);

    }

    public function updateStatusPembayaran(Request $request, $id) {

        $request->validate([
            'status_pembayaran' => ['required', Rule::enum(StatusPembayaran::class)],
        ]);

        $transaksi = Transaksi::findOrFail($id);

        if (Auth::user()->role === Role::ROLE['admin_toko']) {
            if(StatusPembayaran::from($request->status_pembayaran) === StatusPembayaran::SETENGAHBAYAR) {
                $transaksi->status_pembayaran = StatusPembayaran::SETENGAHBAYAR;
                $transaksi->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Status pembayaran berhasil diubah menjadi setengah bayar',
                ], 200);
            } else if(StatusPembayaran::from($request->status_pembayaran) === StatusPembayaran::LUNAS) {
                $transaksi->status_pembayaran = StatusPembayaran::LUNAS;
                $transaksi->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Status pembayaran berhasil diubah menjadi lunas',
                ], 200);
            }
        }

        return response()->json([
            'success' => false,
            'message' => 'Aksi tidak valid untuk peran Anda.',
        ], 403);

    }


    public function update(Request $request, $id) {
        $data = $request->validate([
            'status' => ['required', Rule::enum(StatusTransaksi::class)],
        ]);

        $transaksi = Transaksi::findOrFail($id);

        if (Auth::user()->role === Role::ROLE['admin_toko']) {
            return $this->handleAdminTokoActions($request, $transaksi);
        } elseif (Auth::user()->role === Role::ROLE['kurir']) {
            return $this->handleKurirActions($request, $transaksi);
        } elseif (Auth::user()->role === Role::ROLE['reseller']) {
            return $this->handleResellerActions($request, $transaksi);
        }

        return response()->json([
            'success' => false,
            'message' => 'Aksi tidak valid untuk peran Anda.',
        ], 403);
    }

    private function handleAdminTokoActions(Request $request , Transaksi $transaksi) {

        $status = StatusTransaksi::from($request->status);

        if ($status === StatusTransaksi::DIPROSES) {
            return $this->prosesPesanan($transaksi);
        } elseif ($status === StatusTransaksi::DIKIRIM) {
            return $this->kirimPesanan($transaksi);
        }

        return response()->json([
            'success' => false,
            'message' => 'Status tidak valid untuk admin toko.',
        ], 400);

    }

    private function prosesPesanan(Transaksi $transaksi) {
        $pesanan = Pesanan::with('produk')->where('id_transaksi', $transaksi->id)->get();

        foreach ($pesanan as $item) {

            $produk = Produk::find($item->produk->id);

            if(!$produk->isPersediaanMencukupi($item->jumlah)) {
                return response()->json([
                    'success' => false,
                    'message' => "Persediaan {$item->produk->nama_produk} tidak mencukupi",
                ], 200);
            }

            // kurangi persediaan produk
            $produk->persediaan -= $item->jumlah;
            $produk->save();

            // catat log mutasi
            Mutasi::create([
                'id_produk' => $produk->id,
                'jumlah' => $item->jumlah,
                'jenis' => 'keluar',
                'keterangan' => 'Pengiriman pesanan'
            ]);

        }

        $transaksi->status = StatusTransaksi::DIPROSES;
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diterima',
        ], 200);
    }

    private function kirimPesanan(Transaksi $transaksi) {
        if ($transaksi->status !== StatusTransaksi::DIPROSES) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan belum diproses',
            ], 200);
        }


        $transaksi->status = StatusTransaksi::DIKIRIM;
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dikirim',
        ], 200);
    }

    private function handleKurirActions(Request $request, Transaksi $transaksi) {
        $transaksi = Transaksi::with(['user', 'user.reseller_detail'])->findOrFail($transaksi->id);
        /* FIX: this */

        if ($transaksi->status === StatusTransaksi::DIKIRIM && $request->status === StatusTransaksi::STATUS['dibayar']  )           {


            $transaksi->status = StatusTransaksi::STATUS['dibayar'];
            $transaksi->save();

        }

        $transaksi['total_harga'] = $transaksi->totalHarga();

        $message = $transaksi->status === StatusTransaksi::STATUS['dibayar'] ?
            'Pembayaran telah dibayar pada ' . $transaksi->updated_at :
            'Transaksi selesai dibayar';

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $transaksi,
        ], 200);

    }
    private function handleResellerActions(Request $request, Transaksi $transaksi) {

        if (StatusTransaksi::from($request->status) === StatusTransaksi::DITERIMA) {
            $transaksi->status = StatusTransaksi::SELESAI;
            $transaksi->save();

        }

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diterima',
            'data' => $transaksi,
        ], 200);

    }

    public function show($id) {

        $transaksi = Transaksi::with(['produk', 'user', 'user.reseller_detail'])->findOrFail($id);

        if($transaksi) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan data transaksi',
                'data' => $transaksi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mendapatkan data transaksi'
        ], 500);


    }

    public function detail(Request $request) {

        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id'
        ]);

        $pesanan = Pesanan::with(['produk'])->where('id_transaksi', $request->id_transaksi)->get();

        if($pesanan->isNotEmpty()) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil mendapatkan detail transaksi',
                'data' => $pesanan
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mendapatkan detail transaksi'
        ], 500);

    }

}
