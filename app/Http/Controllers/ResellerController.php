<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class ResellerController extends Controller
{
    public function index() {
        $keranjang = Keranjang::where('id_user', Auth::id())->first();
        $keranjang = Pesanan::where('id_keranjang', $keranjang->id)->count();

        $pesanan = Transaksi::where('id_user', Auth::id())->where('status', '!=', 'selesai')->count();

        return view('reseller.index', [
            'page' => 'Dashboard',
            'keranjang' => $keranjang,
            'pesanan' => $pesanan
        ]);
    }

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
