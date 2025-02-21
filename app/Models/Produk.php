<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = ['nama_produk', 'kode_produk', 'harga_beli', 'harga_jual', 'biaya_penyimpanan', 'biaya_pemesanan', 'deskripsi'];

    public function persediaan() {
        return $this->hasOne(Persediaan::class, 'id_produk');
    }

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'id_produk');
    }

}
