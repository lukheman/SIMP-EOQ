<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Helpers\QrcodeHelper;

use Illuminate\Support\Facades\Auth;

use App\Models\Produk;

use App\Constants\StatusTransaksi;



class AdminTokoController extends Controller
{

    public function index() {
        $pesanan = Transaksi::where('status', StatusTransaksi::PENDING)->count();
        $total_penjualan = Transaksi::where('status', StatusTransaksi::SELESAI)->count();
        $persediaan_barang = Produk::with('persediaan')->get()->sum('persediaan.jumlah');

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
        return view('admin_toko.laporan-penjualan', [
            'page' => 'Laporan Penjualan',
        ]);
    }

}
