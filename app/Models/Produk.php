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

    public function restock() {
        return $this->hasMany(Restock::class, 'id_produk');
    }

    public function mutasi() {
        return $this->hasMany(Mutasi::class, 'id_produk');
    }

    public function isPersediaanMencukupi(int $permintaan): bool
    {
        return $this->persediaan >= $permintaan;
    }

    public function economicOrderQuantity() {

        $periode = Carbon::now()->subMonth(2); // bulan lalu

        $D = Mutasi::where('id_produk', $this->id)
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $S = $this->biaya_pemesanan;
        $H = $this->biaya_penyimpanan;

        return sqrt((2 * $D * $S) / $H);

    }


    public function safetyStock() {

        $periode = Carbon::now()->subMonth(); // bulan lalu

        $D = Mutasi::where('id_produk', $this->id)
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $PM = Mutasi::penjualanMaksimum($this->id, $periode); // penjualan maksimum
        $PRR = $D / 4; // penjualan rata-rata dibagi 4 (perminggu)
        $LT = $this->lead_time; // waktu tunggu

        /* dd($PM, $PRR); */
        return ($PM - $PRR) * $LT;
    }

    public function reorderPoint() {

        $SS = $this->safetyStock();
        $LT = $this->lead_time; // waktu tunggu
        $Q = Mutasi::rataRataPenjualan($this->id, Carbon::now()->subMonth());
        return $SS + ($LT * $Q);
    }



}
