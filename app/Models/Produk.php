<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded = [];

    public function persediaan() {
        return $this->hasOne(Persediaan::class, 'id_produk');
    }

    public function pesanan() {
        return $this->hasMany(Pesanan::class, 'id_produk');
    }

    public function mutasi() {
        return $this->hasMany(Mutasi::class, 'id_produk');
    }

    public static function cekPersediaanProduk(int $permintaan, int $id_produk): bool
    {
        $produk = Produk::find($id_produk);

        return $produk ? $produk->persediaan >= $permintaan : false;
    }

}
