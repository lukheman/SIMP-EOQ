<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Persediaan;
use App\Models\Transaksi;
use App\Models\Mutasi;

class AdminGudangController extends Controller
{

    public function barangMasuk() {
        $barang_masuk = Mutasi::with('produk')->where('jenis', 'masuk')->get();

        return view('admin_gudang.barang-masuk', [
            'page' => 'Barang Masuk',
            'barang_masuk' => $barang_masuk
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

        return response()->json([
            'success' => true,
            'message' => 'berhasil menghitung eoq',
            // 'data' => $persediaan
        ], 200);

    }


    public function laporanBarangMasuk() {
        $barang_masuk = Mutasi::with('produk')->where('jenis', 'masuk')->get();

        return view('admin_gudang.laporan-barang-masuk', [
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
            'ttd' => 'Kepala Gudang'
        ]);
    }


}
