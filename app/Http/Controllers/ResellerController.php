<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Transaksi;

class ResellerController extends Controller
{

    public function katalog() {
        $produk = Produk::all();

        return view('reseller.katalog', [
            'page' => 'Katalog',
            'produk' => $produk
        ]);
    }

    public function pesanan() {
        $pesanan = Transaksi::with('produk')->get();

        return view('reseller.pesanan', [
            'page' => 'Pesanan',
            'pesanan' => $pesanan
        ]);
    }

    public function pengiriman() {
        return view('reseller.pengiriman.show', [
            'page' => 'Pengiriman'
        ]);
    }

}
