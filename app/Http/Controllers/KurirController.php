<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class KurirController extends Controller
{

    public function pesanan() {
        $pesanan = Transaksi::with('produk')->with('user')->get();

        // dd($pesanan);

        return view('kurir.pesanan', [
            'page' => 'Pesanan',
            'pesanan' => $pesanan
        ]);
    }

    public function scanQrcode() {
        return view('kurir.scan-qrcode', [
            'page' => 'Konfirmasi Pembayaran'
        ]);
    }

    public function konfirmasiPembayaran(Request $request) {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id'
        ]);

        $transaksi = Transaksi::with(['produk', 'user', 'user.reseller_detail'])->findOrFail($request->id_transaksi);

        if($transaksi->status === 'dibayar') {
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran telah dikonfirmasi pada ' . $transaksi->updated_at,
                'data' => $transaksi
            ]);
        }

        $transaksi->status = 'dibayar';
        $transaksi->save();

        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfimasi',
            'data' => $transaksi
        ], 200);


    }

}
