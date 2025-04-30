<?php

namespace App\Models;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Mutasi extends Model
{
    protected $table = 'mutasi';
    protected $guarded = [];
    protected $appends = ['total_harga_jual', 'total_harga_beli'];

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function getTotalHargaJualAttribute() {
        return $this->produk->harga_jual * $this->jumlah;
    }

    public function getTotalHargaBeliAttribute() {
        return $this->produk->harga_beli * $this->jumlah;
    }

    public static function penjualanMaksimum($id_produk, $periode1, $periode2) {
        /* $periode1 = Carbon::parse($periode1)->subMonth(); */
        /* $periode2 = Carbon::parse($periode2)->subMonth(); */

        $penjualanPeriode1 = self::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode1->year)
            ->whereMonth('tanggal', $periode1->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $penjualanPeriode2 = self::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode2->year)
            ->whereMonth('tanggal', $periode2->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        return max($penjualanPeriode1, $penjualanPeriode2);

    }

    // rata-rata penjualan harian
    public static function rataRataPenjualan($id_produk, Carbon $periode) {

        /* $periode = Carbon::parse($periode); */

        $penjualan = self::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode->subMonth()->year)
            ->whereMonth('tanggal', $periode->subMonth()->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $rata_rata = $penjualan / $periode->daysInMonth;

        return $rata_rata;

    }


}
