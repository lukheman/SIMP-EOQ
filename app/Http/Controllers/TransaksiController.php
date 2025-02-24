<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaksi;
use App\Models\Produk;

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
        $data  = $request->validate([
            'status' => 'required|in:pending,diproses,ditolak,dikirim,selesai,batal,dibayar',
        ]);


        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status = $request->status;
        $transaksi->save();

        if($request->status === 'dikirim') {
            $pesanan = Pesanan::with('produk')->where('id_transaksi', $transaksi->id)->get();

            foreach ($pesanan as $item) {
                $produk = Produk::find($item->produk->id);
                $produk->persediaan = $produk->persediaan - $item->jumlah;
                $produk->save();
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Transaksi berhasil ' . $request->status,
            'data' => $transaksi
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

        if($pesanan) {
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
