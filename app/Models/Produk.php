<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mutasi;
use App\Providers\PerhitunganEOQServices;

class Produk extends Model
{
    protected $table = 'produk';
    protected $guarded = [];

    public function persediaan() {
        return $this->hasOne(Persediaan::class, 'id_produk');
    }

    public function pesanan()    {
        return $this->hasMany(Pesanan::class, 'id_produk');
    }
    public function restock()    {
        return $this->hasMany(Restock::class, 'id_produk');
    }
    public function mutasi()     {
        return $this->hasMany(Mutasi::class, 'id_produk');
    }

    public function biayaPemesanan()   {
        return $this->hasOne(BiayaPemesanan::class, 'id_produk');
    }

    public function biayaPenyimpanan() {
        return $this->hasOne(BiayaPenyimpanan::class, 'id_produk');
    }

    public function isPersediaanMencukupi(int $permintaan): bool
    {
        return $this->persediaan->jumlah >= $permintaan;
    }

    public static function EOQPerBulan($periode)
    {
        $result = [];

        try {
            $tanggal = Carbon::createFromFormat('Y-m', $periode)->startOfMonth();
        } catch (\Exception $e) {
            return ['error' => 'Format periode tidak valid. Gunakan format Y-m (contoh: 2024-05).'];
        }

        $produkList = self::with(['biayaPemesanan', 'biayaPenyimpanan'])->get();

        foreach ($produkList as $produk) {
            $D = Mutasi::where('id_produk', $produk->id)
                ->where('jenis', 'keluar')
                ->whereYear('tanggal', $tanggal->year)
                ->whereMonth('tanggal', $tanggal->month)
                ->sum('jumlah');

            $S = optional($produk->biayaPemesanan)->biaya ?? 0;
            $H = optional($produk->biayaPenyimpanan)->biaya ?? 1;

            $EOQ = PerhitunganEOQServices::hitungEOQ($D, $S, $H);

            $PM = Mutasi::penjualanMaksimum($produk->id, $tanggal);
            $PRR = $D / 4;
            $LT = $produk->lead_time;

            $SS = PerhitunganEOQServices::hitungSafetyStock($PM, $PRR, $LT);

            $Q = Mutasi::rataRataPenjualan($produk->id, $tanggal) ?? 0;
            $ROP = PerhitunganEOQServices::hitungROP($SS, $Q, $LT);

            $result[] = [
                'produk' => $produk,
                'eoq' => $EOQ,
                'safety_stock' => $SS,
                'reorder_point' => $ROP,
            ];
        }

        return $result;
    }

    public function economicOrderQuantity(): float
    {
        $periode1 = Carbon::now()->subMonth(2);
        $periode2 = Carbon::now()->subMonth(1);

        $D = PerhitunganEOQServices::penjualanBulanan($this->id, $periode1) +
            PerhitunganEOQServices::penjualanBulanan($this->id, $periode2);

        $S = optional($this->biayaPemesanan)->biaya ?? 0;
        $H = optional($this->biayaPenyimpanan)->biaya ?? 1;

        return PerhitunganEOQServices::hitungEOQ($D, $S, $H);
    }

    public function safetyStock(): float
    {
        $periode1 = Carbon::now()->subMonth(2);
        $periode2 = Carbon::now()->subMonth(1);

        $jumlah1 = PerhitunganEOQServices::penjualanBulanan($this->id, $periode1);
        $jumlah2 = PerhitunganEOQServices::penjualanBulanan($this->id, $periode2);

        $D = $jumlah1 + $jumlah2;
        $PM = max($jumlah1, $jumlah2);
        $PRR = $D / 2;
        $LT = $this->lead_time;

        return PerhitunganEOQServices::hitungSafetyStock($PM, $PRR, $LT);
    }

    public function reorderPoint(): float
    {
        $periode1 = Carbon::now()->subMonth(2);
        $periode2 = Carbon::now()->subMonth(1);
        $LT = $this->lead_time;
        $SS = $this->safetyStock();

        $Q = PerhitunganEOQServices::penjualanRataRataHarian($this->id, $periode1, $periode2);

        return PerhitunganEOQServices::hitungROP($SS, $Q, $LT);
    }
}
