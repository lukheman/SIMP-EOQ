<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mutasi;
use App\Models\Produk;
use App\Models\Restock;

use Carbon\Carbon;

class MutasiController extends Controller
{

    public function store(Request $request) {

        $data = $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required',
            'jenis' => 'required',
        ]);

        $produk = Produk::find($request->id_produk);

        $mutasi =  Mutasi::create($data);


        if ($request->jenis === 'masuk') {
            $restock = Restock::where('id_produk', $request->id_produk)->first();

            $tanggalPesan = Carbon::parse($restock->tanggal_pesan);
            $tanggalSelesai = Carbon::now();

            // Hitung selisih hari
            $leadTime = $tanggalPesan->diffInDays($tanggalSelesai);

            $produk->persediaan += $request->jumlah;
            $produk->lead_time = $leadTime;
            $produk->save();

            $restock->delete();


            // hapus pesanan restock

            // update lead time



        } else {
            $produk->persediaan -= $request->jumlah;
            $produk->save();
        }

        $message = $request->jenis == 'masuk' ? 'Berhasil menambahkan data barang masuk' : 'Berhasil menambahkan data barang keluar';

        if($mutasi) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $mutasi
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan data mutasi'
        ], 500);

    }

    public function destroy($id) {
        $penjualan = Mutasi::find($id)?->delete();

        return response()->json([
            'success' => true,
            'message' => 'Log mutasi berhasil dihapus'
        ], 200);
    }

    public function show($id) {
        $mutasi = Mutasi::with('produk')->find($id);

        if($mutasi) {
            return response()->json([
                'success' => true,
                'message' => 'Data mutasi berhasil didapatkan.',
                'data' => $mutasi
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Data mutasi gagal didapatkan.'
        ], 500);
    }

    public function update(Request $request, $id) {

        $data = $request->validate([
            'jumlah' => 'required',
            'tanggal' => 'required',
        ]);

        $mutasi = Mutasi::find($id);

        $mutasi->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Data mutasi berhasil diperbarui',
            'data' => $mutasi
        ], 200);

    }

}
