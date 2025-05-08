<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BiayaPenyimpanan extends Model
{
    protected $table = 'biaya_penyimpanan';
    protected $guarded = [];

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
}
