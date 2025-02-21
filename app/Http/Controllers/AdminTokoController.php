<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminTokoController extends Controller
{


    public function pesananReseller() {
        return view('admin_toko.pesanan-reseller', ['page' => 'Pesanan Reseller']);
    }
}
