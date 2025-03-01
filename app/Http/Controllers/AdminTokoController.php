<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Helpers\QrcodeHelper;

use Illuminate\Support\Facades\Auth;

use App\Models\Produk;

class AdminTokoController extends Controller
{


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

}
