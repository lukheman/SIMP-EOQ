<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    protected $table = 'penjualan';
    protected $guarded = [];

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
