<?php

namespace App\Http\Controllers;

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

        $qrcode = QrcodeHelper::getQrcodeString($request->id_transaksi);

        return view('invoices.nota', [ 
            'qrcode' => $qrcode
        ]);
    }
}
