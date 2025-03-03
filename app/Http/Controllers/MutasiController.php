<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mutasi;

class MutasiController extends Controller
{

    public function destroy($id) {
        $penjualan = Mutasi::find($id)?->delete();

        return response()->json([
            'success' => true,
            'message' => 'Log penjualan berhasil dihapus'
        ], 200);
    }

}
