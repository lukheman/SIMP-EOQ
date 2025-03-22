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

        $barang_masuk = Mutasi::select(
            'id_produk',
            DB::raw('SUM(jumlah) as total_jumlah'),
            DB::raw('SUM(jumlah * produk.harga_beli) as total_harga')
        )
        ->join('produk', 'mutasi.id_produk', '=', 'produk.id') // Gabungkan dengan tabel produk
        ->whereYear('tanggal', $tahun)
        ->whereMonth('tanggal', $bulan)
        ->where('jenis', 'masuk')
        ->groupBy('id_produk', 'produk.harga_beli') // Tambahkan harga_beli ke groupBy agar tidak error
        ->get();

        return view('invoices.laporan-barang-masuk', [
            'barang_masuk' => $barang_masuk,
            'periode' => $request->periode,
            'ttd' => 'Kepala Gudang'
        ]);
    }
}
