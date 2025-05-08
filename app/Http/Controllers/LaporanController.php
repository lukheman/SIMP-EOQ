<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use App\Models\Mutasi;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanController extends Controller
{

public function laporanPenjualan(Request $request)
    {
        // Validate input
        $request->validate([
            'periode' => 'required|date_format:Y-m',
            'ttd' => 'required|string|max:255',
        ]);

        // Parse periode
        $periode = Carbon::createFromFormat('Y-m', $request->periode)->startOfMonth();
        $year = $periode->year;
        $month = $periode->month;
        $jumlahHari = $periode->daysInMonth;

        // Fetch and group sales data
        $penjualan = Mutasi::with('produk')
            ->select(
                'mutasi.*',
                DB::raw('SUM(mutasi.jumlah) OVER (PARTITION BY mutasi.id_produk) / ? AS rata_rata_harian'),
                DB::raw('COUNT(*) OVER (PARTITION BY mutasi.id_produk) AS total_mutasi')
            )
            ->where('jenis', 'keluar')
            ->whereYear('tanggal', $year)
            ->whereMonth('tanggal', $month)
            ->orderBy('id_produk')
            ->orderBy('tanggal')
            ->setBindings([$jumlahHari, 'keluar', $year, $month])
            ->get();

        // Group sales by product
        $groupedPenjualan = $penjualan->groupBy('id_produk')->map(function ($sales) {
            return [
                'items' => $sales,
                'rowspan' => $sales->count(),
                'rata_rata_harian' => $sales->first()->rata_rata_harian,
            ];
        });

        // Calculate total sales
        $total = $penjualan->sum('total_harga_jual');

        return view('invoices.laporan-penjualan', [
            'groupedPenjualan' => $groupedPenjualan,
            'total' => $total,
            'periode' => $periode->format('Y-m'),
            'ttd' => $request->ttd,
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
