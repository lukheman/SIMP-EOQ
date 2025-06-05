<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Carbon\Carbon;
use App\Models\Mutasi;
use App\Models\Produk;

class PerhitunganEOQServices extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    public static function hitungEOQ(float $D, float $S, float $H): float
    {
        return $D > 0 ? round(sqrt((2 * $D * $S) / $H), 2) : 0;
    }

    public static function hitungSafetyStock(float $PM, float $PRR, int $LT): float
    {
        return ($PM - $PRR) * $LT;
    }

    public static function hitungROP(float $SS, float $Q, int $LT): float
    {
        return round($SS + ($LT * $Q), 2);
    }

    public static function penjualanBulanan(int $produkId, Carbon $periode): int
    {
        return Mutasi::where('id_produk', $produkId)
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');
    }

    public static function penjualanRataRataHarian(int $produkId, Carbon $periode1, Carbon $periode2): float
    {
        $jumlah = self::penjualanBulanan($produkId, $periode1) + self::penjualanBulanan($produkId, $periode2);
        $hari = $periode1->daysInMonth + $periode2->daysInMonth;
        return $hari > 0 ? round($jumlah / $hari, 2) : 0;
    }
}
