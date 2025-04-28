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

    public function konfirmasiPembayaran(Request $request, $id) {
        $request->validate([
            'status_pembayaran' => ['required', Rule::enum(StatusPembayaran::class)],
        ]);

        $transaksi = Transaksi::with(['user', 'user.reseller_detail'])->findOrFail($id);

        if($transaksi->status === StatusTransaksi::DIKIRIM) {
            $transaksi->status = StatusTransaksi::DITERIMA;
            $transaksi->save();

            $transaksi['total_harga'] = $transaksi->totalHarga();

            return response()->json([
                'success' => true,
                'message' => 'Pesanan telah diserahkan ke pembeli',
                'data' => $transaksi
            ], 200);
        }

    }

}
