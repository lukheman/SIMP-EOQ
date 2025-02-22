<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTokoController extends Controller
{


    public function pesanan() {
        $pesanan = Transaksi::with('produk')->with('user')->get();

        // dd($pesanan);

        return view('admin_toko.pesanan', [
            'page' => 'Pesanan',
            'pesanan' => $pesanan
        ]);
    }

}
