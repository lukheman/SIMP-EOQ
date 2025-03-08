<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;

class PemilikTokoController extends Controller
{

    public function penjualan() {
        $penjualan = Mutasi::where('jenis', 'keluar')->get();

        return view('pemilik_toko.penjualan', [
            'page' => 'Penjualan',
            'penjualan' => $penjualan
        ]);
    }

    public function laporanPenjualan(Request $request) {
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
}
