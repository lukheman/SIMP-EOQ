<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{

    public function katalog() {
        $produk = Produk::all();

        return view('reseller.katalog', [
            'page' => 'Katalog',
            'produk' => $produk
        ]);
    }

    public function keranjang() {
        $keranjang = Keranjang::where('id_user', Auth::id())->first();

        if($keranjang) {
            $pesanan = Pesanan::with(['produk'])->where('id_keranjang', $keranjang->id)->get();

            return view('reseller.keranjang', [
                'page' => 'Keranjang',
                'pesanan' => $pesanan
            ]);
        }

            return view('reseller.keranjang', [
                'page' => 'Keranjang',
                'pesanan' => []
            ]);

    }


    public function pesanan() {
        $pesanan = Transaksi::where('id_user', Auth::id())->get();

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
