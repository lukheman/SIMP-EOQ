<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    protected $table = 'keranjang';
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class, 'id_pesanan');
    }
}
