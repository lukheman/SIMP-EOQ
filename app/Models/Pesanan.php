<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $guarded = [];

    protected $appends = ['cukup'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function getCukupAttribute()
    {
        return $this->produk ? $this->produk->isPersediaanMencukupi($this->jumlah) : false;
    }
}
