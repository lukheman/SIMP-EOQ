<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Constants\MetodePembayaran;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $guarded = [];

    protected $casts =  [
        'metod_pembayaran' => MetodePembayaran::class
    ];

    public function pesanan() {
        return $this->hasMany(Pesanan::class, 'id_pesanan');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function totalHarga() {

        $total_harga = 0;

        $pesanan = Pesanan::where('id_transaksi', $this->id)->get();

        foreach ($pesanan as $item) {
            $total_harga += $item->total_harga;
        }

        return $total_harga;

    }

}
