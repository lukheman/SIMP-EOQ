<?php

namespace App\Http\Controllers;

use App\Constants\Role;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaksi;
use App\Models\Produk;
use App\Models\Penjualan;

use App\Constants\Status;

class TransaksiController extends Controller
{

    public function store(Request $request) {

        // TODO:refactoring

        $data = $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $produk = Produk::find($request->id_produk);
        $total_harga = $produk->harga_jual * $request->jumlah;

        $id_user = Auth::user()->id;
        $transaksi = Transaksi::create([
            'id_user' => $id_user,
            'id_produk' => $request->id_produk,
            'jumlah' => $request->jumlah,
            'harga' => $total_harga
        ]);

        if($transaksi) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil melakukan pembelian ' . $produk->nama_produk,
                'data' => $produk
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal melakukan pembelian'
        ], 500);

    }


    public function update(Request $request, $id) {
        $data = $request->validate([
            'status' => 'required|in:pending,diproses,ditolak,dikirim,selesai,batal,dibayar',
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
        if ($request->status === Status::STATUS['diproses']) {
            return $this->prosesPesanan($transaksi);
        } elseif ($request->status === Status::STATUS['dikirim']) {
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

            // buat log penjualan ketika persediaan mencukup
            Penjualan::create([
                'id_produk' => $item->id_produk,
                'jumlah' => $item->jumlah,
                'total_harga' =>  $item->total_harga
            ]);

        }

        $transaksi->status = Status::STATUS['diproses'];
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diterima',
        ], 200);
    }

    private function kirimPesanan(Transaksi $transaksi) {
        if ($transaksi->status !== Status::STATUS['diproses']) {
            return response()->json([
                'success' => false,
                'message' => 'Pesanan belum diproses',
            ], 200);
        }

        $pesanan = Pesanan::with('produk')->where('id_transaksi', $transaksi->id)->get();

        foreach ($pesanan as $item) {
            $produk = Produk::find($item->produk->id);
            $produk->persediaan -= $item->jumlah;
            $produk->save();
        }

        $transaksi->status = Status::STATUS['dikirim'];
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dikirim',
        ], 200);
    }

    private function handleKurirActions(Request $request, Transaksi $transaksi) {
        $transaksi = Transaksi::with(['user', 'user.reseller_detail'])->findOrFail($transaksi->id);

        if ($transaksi->status === Status::STATUS['dikirim'] && $request->status === Status::STATUS['dibayar']  ) {


            $transaksi->status = Status::STATUS['dibayar'];
            $transaksi->save();

        }

        $transaksi['total_harga'] = $transaksi->totalHarga();

        $message = $transaksi->status === Status::STATUS['dibayar'] ?
            'Pembayaran telah dibayar pada ' . $transaksi->updated_at :
            'Transaksi selesai dibayar';

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $transaksi,
        ], 200);

    }
    private function handleResellerActions(Request $request, Transaksi $transaksi) {

        if ($transaksi->status === Status::STATUS['dibayar'] && $request->status === Status::STATUS['selesai']) {
            $transaksi->status = Status::STATUS['selesai'];
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
