<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Mutasi;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function laporanPenjualan(Request $request ) {
        $request->validate([
            'periode' => 'required',
            'ttd' => 'required'
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
            'ttd' => $request->ttd
        ]);

    }

    public function laporanBarangMasuk(Request $request) {

        $request->validate([
            'periode' => 'required',
            'ttd' => 'required'
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
            'ttd' => $request->ttd
        ]);
    }

    public function laporanPersediaanProduk() {

        $produk = Produk::all();

        return view('invoices.laporan-persediaan-produk', [
            'produk' => $produk,
            'ttd' => 'Pemilik Toko'
        ]);
    }

}
