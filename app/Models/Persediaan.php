<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Persediaan extends Model
{
    protected $table = 'persediaan';
    protected $fillable = [
        'id_produk', 'stock', 'periode', 'lead_time', 'reorder_point', 'safety_stock', 'rata_rata_penggunaan',
        'biaya_penyimpanan', 'biaya_pemesanan'
    ];

    public function produk() {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    /* public function hitungEOQ() { */
    /*     $S = $this->biaya_pemesanan; */
    /*     $H = $this->biaya_penyimpanan; */
    /*     $D = $this->pembelian; */
    /*     $PM = $this->penggunaan; */
    /*     $LT = $this->lead_time; */
    /*     $Q = $this->rata_rata_penggunaan; */
    /*     $PRR = $D/2; */
    /**/
    /*     $EOQ = intval(sqrt((2 * $S * $D )/ $H)); */
    /*     $SS = ($PM - $PRR) * $LT; */
    /*     $ROP = $SS + ($LT * $Q); */
    /**/
    /*     $this->eoq = $EOQ; */
    /*     $this->safety_stock = $SS; */
    /*     $this->reorder_point = $ROP; */
    /*     $this->save(); */
    /* } */

    public static function hitungEOQ($periode, $id_produk) {

        $next_periode = Carbon::createFromFormat('Y-m', $periode)->addMonth();
        $next_periode = $next_periode->format('Y-m');

        $periode_awal = Persediaan::where('periode', $periode)->where('id_produk', $id_produk)->get();
        $periode_akhir = Persediaan::where('periode', $next_periode)->where('id_produk', $id_produk)->get();

        $total_pembelian = $periode_awal->pembelian + $periode_akhir->pembelian;
        $total_penggunaan = $periode_awal->penggunaan + $periode_akhir->pengguaan;

        $rata_rata_pembelian = $total_pembelian / 2;
        $rata_rata_penggunaan = $total_penggunaan / 2;

    }

}
