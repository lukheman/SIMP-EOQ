<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Persediaan;
use App\Models\Transaksi;

class AdminGudangController extends Controller
{

    public function logPersediaan() {
        $persediaan = Persediaan::with('produk')->get();

        return view('admin_gudang.log-persediaan', [
            'page' => 'Log Persediaan',
            'persediaan' => $persediaan
        ]);
    }

    public function persediaan() {
        $produk = Produk::all();

        return view('admin_gudang.persediaan', [
            'page' => 'Persediaan',
            'produk' => $produk
        ]);
    }

    public function dataProduk() {
        $produk = Produk::all();
        return view('admin_gudang.produk.show', [
            'page' => 'Data Produk',
            'produk' => $produk
        ]);

    }

    public function eoq() {
        $persediaan = Persediaan::with('produk')->get();

        return view('admin_gudang.eoq', [
            'page' => 'EOQ',
            'persediaan' => $persediaan
        ]);
    }

    public function hitungEOQ(Request $request) {
        $persediaan = Persediaan::all();
        // Persediaan::hitungEOQ();

        /* foreach ($persediaan as $item) { */
        /*     $item->hitungEOQ($item->id); */
        /* } */
        /**/
        return response()->json([
            'success' => true,
            'message' => 'berhasil menghitung eoq',
            // 'data' => $persediaan
        ], 200);

    }


}
