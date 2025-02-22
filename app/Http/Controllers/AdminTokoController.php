<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Helpers\QrcodeHelper;

class AdminTokoController extends Controller
{


    public function pesanan() {
        $pesanan = Transaksi::with('produk')->with('user')->get();

        // dd($pesanan);

        return view('admin_toko.pesanan', [
            'page' => 'Pesanan',
            'pesanan' => $pesanan
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
