<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pesanan;
use App\Models\Keranjang;
use App\Models\Produk;
use App\Models\Transaksi;

class PesananController extends Controller
{

    public function store(Request $request) {

        // TODO:refactoring


        $data = $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $id_user = Auth::user()->id;

        // cari Keranjang reseller/user
        if(!Keranjang::where('id_user', $id_user)->first()) {
            $keranjang = Keranjang::create([
              'id_user' => $id_user
            ]);
        }

        $keranjang = Keranjang::where('id_user', $id_user)->first();

        $produk = Produk::find($request->id_produk);

        // cek persediaan produk
        if(!$produk->isPersediaanMencukupi($request->jumlah)) {
            return response()->json([
                'success' => false,
                'message' => $produk->nama_produk . ' tidak cukup di persediaan'
            ], 200);
        }

        // kalkulasi total harga barang yang dipesan
        $total_harga = $produk->harga_jual * $request->jumlah;

        // buat pesanan
        $pesanan = Pesanan::create([
            'id_user' => $id_user,
            'id_produk' => $request->id_produk,
            'id_keranjang' => $keranjang->id,
            'jumlah' => $request->jumlah,
            'total_harga' => $total_harga,
        ]);

        if($pesanan) {

            return response()->json([
                'success' => true,
                'message' => $produk->nama_produk . ' disimpan ke keranjang',
                'data' => $produk
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => $produk->nama_produk . ' gagal disimpan ke keranjang'
        ], 500);

    }

    public function destroy($id) {
        $pesanan = Pesanan::findOrFail($id);

        $pesanan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dihapus dari keranjang'
        ]);
    }

    public function destroyMany(Request $request) {

        $ids = $request->ids;

        Pesanan::whereIn('id', $ids)->delete();

        $lenIds = count($ids);

        return response()->json([
            'success' => true,
            'message' => "Berhasil menghapus $lenIds pesanan dari keranjang"
        ]);

    }


    public function show($id) {

        $pesanan = Pesanan::query()->with('produk')->find($id);

        return response()->json([
            'success' => true,
            'message' => "Berhasil mendapakan pesanan",
            'data' => $pesanan
        ]);


    }

    public function update(Request $request, $id) {

        $request->validate([
            'jumlah' => 'required|numeric'
        ]);

        $pesanan = Pesanan::with('produk')->find($id);
        $pesanan->jumlah = $request->jumlah;
        $pesanan->total_harga = $request->jumlah * $pesanan->produk->harga_jual;
        $pesanan->save();

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil diperbarui',
            'data' => $pesanan
        ], 200);


    }

}
