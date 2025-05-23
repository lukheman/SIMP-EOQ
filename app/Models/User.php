<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';
    public $timestamps = false;
    public $guarded = [];

    public function transaksi() {
        return $this->hasMany(Transaksi::class, 'id_user');
    }

    public function transaksiKurir() {
        return $this->hasMany(Transaksi::class, 'id_kurir');
    }

    public function reseller_detail() {
        return $this->hasOne(ResellerDetail::class, 'id_user');
    }

    public function keranjang() {
        return $this->hasOne(Keranjang::class);
    }

}
