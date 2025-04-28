<?php

namespace App\Http\Controllers;

use App\Constants\StatusTransaksi;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use Illuminate\Validation\Rule;
use App\Constants\StatusPembayaran;
use App\Constants\MetodePembayaran;

class KurirController extends Controller
{

    public function index() {
        $dikirim = Transaksi::where('status', 'dikirim')->count();
        $diproses = Transaksi::where('status', 'diproses')->count();

        return view('kurir.index', [
            'page' => 'Dashboard',
            'dikirim' => $dikirim,
            'diproses' => $diproses
        ]);
    }

    public function pesanan() {
        $pesanan = Transaksi::with(['user', 'user.reseller_detail'])->where('status', 'dikirim')->get();

        return view('kurir.pesanan', [
            'page' => 'Pesanan',
            'pesanan' => $pesanan
        ]);
    }

    public function konfirmasiPembayaranPage() {
        return view('kurir.konfirmasi-pembayaran', [
            'page' => 'Konfirmasi Pembayaran'
        ]);
    }

    public function konfirmasiPembayaran(Request $request) {
        $request->validate([
            'id_transaksi' => 'required|exists:transaksi,id'
        ]);

        $transaksi = Transaksi::with(['user', 'user.reseller_detail'])->findOrFail($request->id_transaksi);

        if($transaksi->status === 'dibayar') {
            $transaksi['total_harga'] = Transaksi::totalHarga($request->id_transaksi);
            return response()->json([
                'success' => true,
                'message' => 'Pembayaran telah dikonfirmasi pada ' . $transaksi->updated_at,
                'data' => $transaksi
            ]);
        }

        $transaksi->status = 'dibayar';
        $transaksi->save();

        $transaksi['total_harga'] = Transaksi::totalHarga($request->id_transaksi);
        return response()->json([
            'success' => true,
            'message' => 'Pembayaran berhasil dikonfimasi',
            'data' => $transaksi
        ], 200);


    }

}
