<?php

namespace App\Http\Controllers;

use App\Models\Keranjang;
use App\Models\Pesanan;
use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

use App\Constants\MetodePembayaran;
use App\Constants\StatusTransaksi;

class ResellerController extends Controller
{


    public function index() {
        $keranjang = Keranjang::where('id_user', Auth::id())->first();

        // buat keranjang ketika keranjang reseller belum ada
        if($keranjang == null) {
            $keranjang = Keranjang::create([
                'id_user' => Auth::id()
            ]);
        }

        $keranjang = Pesanan::where('id_keranjang', $keranjang->id)->count();

        $pesanan = Transaksi::where('id_user', Auth::id())->where('status', '!=', 'selesai')->count();

        return view('reseller.index', [
            'page' => 'Dashboard',
            'keranjang' => $keranjang,
            'pesanan' => $pesanan
        ]);
    }

    public function katalog(Request $request) {
        $query = $request->input('q');

        $produk = Produk::query()
            ->when($query, function ($q) use ($query) {
                $q->where('nama_produk', 'like', "%{$query}%");
            })
            ->get(); // atau ->get() jika tidak ingin pagination


        return view('reseller.katalog', [
            'page' => 'Katalog',
            'produk' => $produk,
            'query' => $query
        ]);
    }

    public function keranjang() {
        $keranjang = Keranjang::where('id_user', Auth::id())->first();

        if($keranjang) {
            $pesanan = Pesanan::with(['produk'])->where('id_keranjang', $keranjang->id)->get();

            return view('reseller.keranjang', [
                'page' => 'Keranjang',
                'pesanan' => $pesanan
            ]);
        }

            return view('reseller.keranjang', [
                'page' => 'Keranjang',
                'pesanan' => []
            ]);

    }


    public function transaksi(Request $request) {

        $belumbayar = $request->query('belumbayar');
        $pending = $request->query('pending');
        $diproses = $request->query('diproses');
        $dikirim = $request->query('dikirim');
        $selesai = $request->query('selesai');

        $transaksi = Transaksi::where('id_user', Auth::id());

        if($belumbayar === '0') {

            $transaksi = $transaksi
                ->where('metode_pembayaran', MetodePembayaran::TRANSFER)
                ->where('status', StatusTransaksi::PENDING);

        } else if ($pending === '1') {
            $transaksi = $transaksi->where('status', StatusTransaksi::PENDING);
        } else if($diproses === '1') {
            $transaksi = $transaksi->where('status', StatusTransaksi::DIPROSES);
        } else if($dikirim === '1') {
            $transaksi = $transaksi->where('status', StatusTransaksi::DIKIRIM);
        } else if($selesai === '1') {
            $transaksi = $transaksi->whereIn('status', [
                StatusTransaksi::DITERIMA,
                StatusTransaksi::SELESAI,
            ]);
        } else {
            $transaksi = $transaksi
                ->where('metode_pembayaran', MetodePembayaran::TRANSFER)
                ->where('status', StatusTransaksi::PENDING);
        }

        $transaksi = $transaksi->get();


        return view('reseller.transaksi', [
            'page' => 'Transaksi',
            'transaksi' => $transaksi
        ]);

    }

    public function pengiriman() {
        return view('reseller.pengiriman.show', [
            'page' => 'Pengiriman'
        ]);
    }

}
