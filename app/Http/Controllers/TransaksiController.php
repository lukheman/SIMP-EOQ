<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Transaksi;
use App\Models\Produk;

class TransaksiController extends Controller
{
    public function store(Request $request) {

        // TODO: perbaiki kode

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

}
