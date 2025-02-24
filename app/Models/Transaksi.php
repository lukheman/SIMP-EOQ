<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = ['id_user', 'id_produk', 'jumlah', 'status', 'harga' ];

    public function pesanan() {
        return $this->hasMany(Pesanan::class, 'id_pesanan');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

}
