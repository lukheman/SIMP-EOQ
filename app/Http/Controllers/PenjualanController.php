<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Penjualan;

class PenjualanController extends Controller
{

    public function destroy($id) {
        $penjualan = Penjualan::findOrFail($id);

        $penjualan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Log penjualan berhasil dihapus'
        ], 200);
    }

}
