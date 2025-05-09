<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;
use App\Models\Produk;
use App\Models\Transaksi;

class PemilikTokoController extends Controller
{

    public function index() {
        $transaksi = Transaksi::where('status', 'selesai')->count();
        $persediaan_barang = Produk::sum('persediaan');

        return view('pemilik_toko.index', [
            'page' => 'Dashboard',
            'transaksi' => $transaksi,
            'persediaan_barang' => $persediaan_barang
        ]);
    }

    public function laporanPenjualan() {
        $penjualan = Mutasi::where('jenis', 'keluar')->get();

        return view('pemilik_toko.laporan-penjualan', [
            'page' => 'Laporan Penjualan',
            'penjualan' => $penjualan
        ]);
    }

    public function laporanPersediaanProduk() {
        $produk = Produk::all();

        return view('pemilik_toko.laporan-persediaan-produk', [
            'page' => 'Laporan Persediaan Produk',
            'produk' => $produk,
        ]);
    }

    public function persediaan() {
        return view('pemilik_toko.persediaan', [
            'page' => 'Persediaan Produk'
        ]);
    }

    public function laporanBarangMasuk() {
        return view('pemilik_toko.laporan-barang-masuk', [
            'page' => 'Laporan Barang Masuk',
        ]);
    }


}
