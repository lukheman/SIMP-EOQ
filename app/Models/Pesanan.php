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

    public function getJumlahPcsAttribtue() {
        return $this->jumlah * $this->produk->tingkat_konversi;
    }

    public function getTotalHargaAttribute() {
        return ($this->satuan ? $this->produk->harga_jual_unit_kecil : $this->produk->harga_jual) * ($this->jumlah ?? 0);
    }

    public function getLabelTotalHargaJualAttribute()
    {
        $totalHarga = ($this->satuan ? $this->produk->harga_jual_unit_kecil : $this->produk->harga_jual) * ($this->jumlah ?? 0);
        return "Rp. " . number_format($totalHarga, 0, ',', '.');
    }


    public function getLabelJumlahUnitDipesanAttribute()
    {
        $unit = $this->satuan ? $this->produk->unit_kecil : $this->produk->unit_besar;

        $jumlahUnit = $this->jumlah;

        return "{$jumlahUnit} {$unit}";
    }
}
