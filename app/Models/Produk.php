<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

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

    public function isPersediaanMencukupi(int $permintaan): bool
    {
        return $this->persediaan >= $permintaan;
    }

    public function economicOrderQuantity() {

        $bulanAwal = Carbon::now()->subMonth(3);
        $bulanAkhir = Carbon::now()->subMonth(2);

        $tanggalAwal = $bulanAwal->startOfMonth()->toDateString();
        $tanggalAkhir= $bulanAkhir->endOfMonth()->toDateString();

        $D = Mutasi::where('id_produk', $this->id)
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('jenis', 'keluar')
            ->sum('jumlah');


        $S = $this->biaya_pemesanan;
        $H = $this->biaya_penyimpanan;


        return sqrt((2 * $D * $S) / $H);

    }


    public function safetyStock() {

        $bulanAwal = Carbon::now()->subMonth(3);
        $bulanAkhir = Carbon::now()->subMonth(2);

        $tanggalAwal = $bulanAwal->startOfMonth()->toDateString();
        $tanggalAkhir= $bulanAkhir->endOfMonth()->toDateString();

        $D = Mutasi::where('id_produk', $this->id)
            ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $PM = Mutasi::penjualanMaksimum($this->id, $bulanAwal, $bulanAkhir); // penjualan maksimum
        $PRR = $D / 2; // penjualan rata-rata dibagi 2 karena dihitung dari 2 periode
        $LT = $this->lead_time; // waktu tunggu

        return ($PM - $PRR) * $LT;
    }

    public function reorderPoint() {

        $SS = $this->safetyStock();
        $LT = $this->lead_time; // waktu tunggu
        $Q = Mutasi::rataRataPenjualan($this->id, Carbon::now());
        return $SS + ($LT * $Q);
    }



}
