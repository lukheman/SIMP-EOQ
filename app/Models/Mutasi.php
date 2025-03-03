<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasi';
    protected $guarded = [];
    protected $appends = ['total_harga_jual', 'total_harga_beli'];

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function getTotalHargaJualAttribute() { 
        return $this->produk->harga_jual * $this->jumlah;
    }

    public function getTotalHargaBeliAttribute() { 
        return $this->produk->harga_beli * $this->jumlah;
    }
}
