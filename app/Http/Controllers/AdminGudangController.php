<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Produk;
use App\Models\Mutasi;
use App\Models\Restock;

class AdminGudangController extends Controller
{

    public function index() {
        $total_produk = Produk::count();
        $total_persediaan = Produk::sum('persediaan');

        return view('admin_gudang.index', [
            'page' => 'Dashboard',
            'total_produk' => $total_produk,
            'total_persediaan' => $total_persediaan
        ]);
    }

    public function barangMasuk() {
        $barang_masuk = Mutasi::with('produk')->where('jenis', 'masuk')->get();

        return view('admin_gudang.barang-masuk', [
            'page' => 'Barang Masuk',
            'barang_masuk' => $barang_masuk
        ]);
    }

    public function pesanan() {
        $pesanan = Restock::with('produk')->get();

        return view('admin_gudang.pesanan', [
            'page' => 'Pesanan',
            'pesanan' => $pesanan
        ]);
    }

    public function persediaan() {
        $produk = Produk::all();

        return view('admin_gudang.persediaan', [
            'page' => 'Persediaan',
            'produk' => $produk
        ]);
    }

    public function produk() {
        $produk = Produk::all();
        return view('admin_gudang.produk', [
            'page' => 'Produk',
            'produk' => $produk
        ]);
    }


    private function getPM($periode1, $periode2, $id_produk) {
        $periode1 = new DateTime($periode1);
        $periode2 = new DateTime($periode2);

        $penjualanPeriode1 = Mutasi::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode1->format('Y'))
            ->whereMonth('tanggal', $periode1->format('m'))
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $penjualanPeriode2 = Mutasi::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode2->format('Y'))
            ->whereMonth('tanggal', $periode2->format('m'))
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        return max($penjualanPeriode1, $penjualanPeriode2);

    }

    private function cekLogPenjualan($periode, $id_produk) {
        list($tahun, $bulan) = explode('-', $periode);

        $penjualan = Mutasi::where('jenis', 'keluar')
            ->whereYear($tahun)
            ->whereMonth($bulan)
            ->count();

        return $penjualan > 0;

    }

    public function eoq() {

        $produk = Produk::all();

        return view('admin_gudang.eoq', [
            'page' => 'EOQ',
            'produk' => $produk
        ]);
    }

    public function laporanPenjualan() {
        $penjualan = Mutasi::where('jenis', 'keluar')->get();

        return view('admin_gudang.laporan-penjualan', [
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
            'ttd' => 'Kepala Gudang'
        ]);
    }

    public function laporanBarangMasuk() {
        $barang_masuk = Mutasi::with('produk')->where('jenis', 'masuk')->get();

        return view('admin_gudang.laporan-barang-masuk', [
            'page' => 'Laporan Barang Masuk',
            'barang_masuk' => $barang_masuk
        ]);
    }


}
