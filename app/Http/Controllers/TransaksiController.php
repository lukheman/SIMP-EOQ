<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use App\Constants\MetodePembayaran;
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

    public function get() {
        Transaksi::get();
    }

    public function store(Request $request) {
        $request->validate([
            'metode_pembayaran' => ['required', Rule::enum(MetodePembayaran::class)],
            'pesanan_dipilih' => 'required'
        ]);

        $pesanan_dipilih = $request->input('pesanan_dipilih');
        $pesanan_dipilih = explode(',', $pesanan_dipilih);

        // FIX: fix ketika keranjang belum ada
        $keranjang = Keranjang::where('id_user', Auth::id())->first();

        // buat transaksi
        $transaksi = Transaksi::create([
            'id_user' => Auth::id(),
            'metode_pembayaran' => $request->metode_pembayaran
        ]);

        Pesanan::where('id_keranjang', $keranjang->id)->update([
            'id_transaksi' => $transaksi->id,
            'id_keranjang' => null
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Berhasil melakukan pemesanan barang',
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
        if ($request->status === StatusTransaksi::STATUS['diproses']) {
            return $this->prosesPesanan($transaksi);
        } elseif ($request->status === StatusTransaksi::STATUS['dikirim']) {
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
            if (!Produk::cekPersediaanProduk($item->jumlah, $item->id_produk)) {
                return response()->json([
                    'success' => false,
                    'message' => "Persediaan {$item->produk->nama_produk} tidak mencukupi",
                ], 200);
            }

        }

        $transaksi->status = StatusTransaksi::STATUS['diproses'];
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diterima',
        ], 200);
    }

    private function kirimPesanan(Transaksi $transaksi) {
        if ($transaksi->status !== StatusTransaksi::STATUS['diproses']) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan belum diproses',
            ], 200);
        }

        $pesanan = Pesanan::with('produk')->where('id_transaksi', $transaksi->id)->get();

        foreach ($pesanan as $item) {
            $produk = Produk::find($item->produk->id);

            // kurangi persediaan produk
            $produk->persediaan -= $item->jumlah;
            $produk->save();

            // catat log mutasi
            Mutasi::create([
                'id_produk' => $item->id_produk,
                'jumlah' => $item->jumlah,
                'jenis' => 'keluar',
                'keterangan' => 'Pengiriman pesanan'
            ]);

        }

        $transaksi->status = StatusTransaksi::STATUS['dikirim'];
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dikirim',
        ], 200);
    }

    private function handleKurirActions(Request $request, Transaksi $transaksi) {
        $transaksi = Transaksi::with(['user', 'user.reseller_detail'])->findOrFail($transaksi->id);

        if ($transaksi->status === StatusTransaksi::STATUS['dikirim'] && $request->status === StatusTransaksi::STATUS['dibayar']  ) {


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

        if ($transaksi->status === StatusTransaksi::STATUS['dibayar'] && $request->status === StatusTransaksi::STATUS['selesai']) {
            $transaksi->status = StatusTransaksi::STATUS['selesai'];
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
