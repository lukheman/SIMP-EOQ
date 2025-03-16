<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Helpers\QrcodeHelper;

use Illuminate\Support\Facades\Auth;

use App\Models\Produk;

class AdminTokoController extends Controller
{

    public function index() { 
        $pesanan = Transaksi::where('status', 'pending')->count();
        $total_penjualan = Transaksi::where('status', 'selesai')->count();
        $persediaan_barang = Produk::sum('persediaan');

        return view('admin_toko.index', [
            'page' => 'Dashboard',
            'pesanan' => $pesanan,
            'total_penjualan' => $total_penjualan,
            'persediaan_barang' => $persediaan_barang
        ]);
    }

    public function pesanan() {
        $pesanan = Transaksi::with('user')->get();

        return view('admin_toko.pesanan', [
            'page' => 'Pesanan',
            'pesanan' => $pesanan
        ]);
    }

    public function persediaan() {
        $produk = Produk::all();

        return view('admin_toko.persediaan', [
            'page' => 'Persediaan',
            'produk' => $produk
        ]);
    }

    public function nota(Request $request) {

        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id'
        ]);

        $pesanan = Pesanan::with(['produk'])->where('id_transaksi', $request->id_transaksi)->get();
        $pengirim = Auth::user();
        $penerima = Transaksi::with('user', 'user.reseller_detail')->first()->user;

        $qrcode = QrcodeHelper::getQrcodeString($request->id_transaksi);

        return view('invoices.nota', [
            'qrcode' => $qrcode,
            'pesanan' => $pesanan,
            'pengirim' => $pengirim,
            'penerima' => $penerima,
        ]);
    }

    public function laporanPenjualan() {
        $penjualan = Mutasi::where('jenis', 'keluar')->get();

        return view('admin_toko.laporan-penjualan', [
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
            'ttd' => 'Kepala Toko'
        ]);

    }

}
