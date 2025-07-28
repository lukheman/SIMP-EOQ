<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mutasi extends Model
{
    protected $table = 'mutasi';

    protected $guarded = [];

    protected $appends = ['total_harga_jual', 'total_harga_beli'];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function getTotalHargaJualAttribute()
    {
        if($this->unit === 'bal') {
            return $this->produk->harga_jual * $this->jumlah;
        }

        return $this->produk->harga_jual_unit_kecil * $this->jumlah;
    }

    public function getTotalHargaBeliAttribute()
    {
        return $this->produk->harga_beli * $this->jumlah;
    }

    public static function penjualanMaksimum($id_produk, $periode)
    {

        $maxMingguan = self::where('id_produk', $id_produk)
            ->where('jenis', 'keluar')
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->selectRaw('YEAR(tanggal) AS tahun, WEEK(tanggal, 1) AS minggu, SUM(jumlah) AS total')
            ->groupBy('tahun', 'minggu')
            ->orderByDesc('total')
            ->first();

        return $maxMingguan->total ?? 0;

    }

    // rata-rata penjualan harian
    public static function rataRataPenjualan($id_produk, Carbon $periode)
    {

        $penjualan = self::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $rata_rata = $penjualan / $periode->daysInMonth;

        return $rata_rata;

    }

    public static function rataRataPenjualanSemua($periode)
    {

        $jumlahHari = $periode->daysInMonth;

        $rataRataPerProduk = self::select('id_produk', DB::raw("SUM(jumlah) / {$jumlahHari} AS rata_rata_harian"))
            ->where('jenis', 'keluar')
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->groupBy('id_produk')
            ->get();

        return $rataRataPerProduk;

    }
}
