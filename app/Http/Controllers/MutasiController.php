<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mutasi;
use App\Models\Produk;

class MutasiController extends Controller
{

    public function store(Request $request) {

        $data = $request->validate([
            'id_produk' => 'required|exists:produk,id',
            'jumlah' => 'required',
            'tanggal' => 'required',
            'jenis' => 'required',
        ]);

        $produk = Produk::find($request->id_produk);

        $mutasi =  Mutasi::create($data);


        if ($request->jenis === 'masuk') {
            $produk->persediaan += $request->jumlah;
            $produk->save();
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

        // validasi data
        $data = $request->validate([
            'id_produk' => 'required',
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
