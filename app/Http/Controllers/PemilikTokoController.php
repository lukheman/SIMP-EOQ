<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;
use App\Models\Produk;

class PemilikTokoController extends Controller
{

    public function laporanPenjualan() {
        $penjualan = Mutasi::where('jenis', 'keluar')->get();

        return view('pemilik_toko.laporan-penjualan', [
            'page' => 'Penjualan',
            'penjualan' => $penjualan
        ]);
    }

    public function cetakLaporanPenjualan(Request $request) {
        $request->validate([
            'periode' => 'required'
        ]);

        list($tahun, $bulan) = explode('-', $request->periode);

        $penjualan = Mutasi::with('produk')
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('jenis', 'keluar')
            ->get();

        return view('invoices.laporan-penjualan', [
            'penjualan' => $penjualan,
            'periode' => $request->periode,
            'ttd' => 'Manager Toko'
        ]);

    }

    public function laporanPersediaanProduk() {
        $produk = Produk::all();

        return view('pemilik_toko.laporan-persediaan-produk', [
            'page' => 'Laporan Persediaan Produk',
            'produk' => $produk,
        ]);
    }

    public function cetakLaporanPersediaanProduk() {

        $produk = Produk::all();

        return view('invoices.laporan-persediaan-produk', [
            'produk' => $produk,
            'ttd' => 'Manager Toko'
        ]);
    }

    public function laporanBarangMasuk() {
        $barang_masuk = Mutasi::with('produk')->where('jenis', 'masuk')->get();

        return view('pemilik_toko.laporan-barang-masuk', [
            'page' => 'Laporan Barang Masuk',
            'barang_masuk' => $barang_masuk
        ]);
    }

    public function cetakLaporanBarangMasuk(Request $request) {

        $request->validate([
            'periode' => 'required'
        ]);

        list($tahun, $bulan) = explode('-', $request->periode);

        $barang_masuk = Mutasi::with('produk')
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('jenis', 'masuk')
            ->get();

        return view('invoices.laporan-barang-masuk', [
            'barang_masuk' => $barang_masuk,
            'periode' => $request->periode,
            'ttd' => 'Manager Toko'
        ]);
    }
}
