<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use Illuminate\Validation\Rule;

use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{

    public function all() {
        $produk = Produk::all();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan',
            'data' => $produk
        ], 200);

    }

    public function store(Request $request) {

        $request->validate([
            'nama_produk' => 'required',
            'kode_produk' => 'required|unique:produk,kode_produk',
            'harga_beli' => 'required|numeric|min:0',
            'harga_jual' => 'required|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'biaya_penyimpanan' => 'required|numeric|min:0',
            'biaya_pemesanan' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $produk = Produk::create($data);

        if($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan',
                'data' => $produk
            ], 201);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal menambahkan produk'
        ], 500);


    }

    public function update(Request $request, $id) {

        // validasi data
        $data = $request->validate([
            'nama_produk' => [
                'required',
                Rule::unique('produk', 'nama_produk')->ignore($id)
            ],
            'kode_produk' => [
                'required',
                Rule::unique('produk', 'kode_produk')->ignore($id)
            ],
            'harga_beli' => 'required|numeric:min:0',
            'harga_jual' => 'required|numeric:min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'biaya_penyimpanan' => 'required|numeric:min:0',
            'biaya_pemesanan' => 'required|numeric:min:0',
            'deskripsi' => 'nullable|string',
        ]);


        $data = $request->all();

        $produk = Produk::findOrFail($id);

        if ($request->hasFile('gambar')) {

            // hapus file lama
            if($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }

            // simpan file baru
            $data['gambar'] = $request->file('gambar')->store('images', 'public');
        }

        $produk->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil diperbarui',
            'data' => $produk
        ], 200);

    }

    public function destroy($id) {
        $produk = Produk::findOrFail($id);

        $produk->delete();

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil dihapus'
        ]);
    }

    public function show($id) {
        $produk = Produk::find($id);

        if($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil didapatkan',
                'data' => $produk
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mendapatkan produk'
        ], 500);
    }

    public function kodeProduk($code) {
        $produk = Produk::where('kode_produk', $code)->first();

        if($produk) {
            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil didapatkan',
                'data' => $produk
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Gagal mendapatkan produk'
        ], 404);

    }
}
