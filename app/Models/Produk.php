<?php

namespace App\Models;

use App\Providers\PerhitunganEOQServices;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $guarded = [];

    public function persediaan()
    {
        return $this->hasOne(Persediaan::class, 'id_produk');
    }

    public function pesanan()
    {
        return $this->hasMany(Pesanan::class, 'id_produk');
    }

    public function restock()
    {
        return $this->hasMany(Restock::class, 'id_produk');
    }

    public function mutasi()
    {
        return $this->hasMany(Mutasi::class, 'id_produk');
    }

    public function biayaPemesanan()
    {
        return $this->hasOne(BiayaPemesanan::class, 'id_produk');
    }

    public function biayaPenyimpanan()
    {
        return $this->hasOne(BiayaPenyimpanan::class, 'id_produk');
    }

    public function isPersediaanMencukupi(int $permintaan): bool
    {
        return $this->persediaan->jumlah >= $permintaan;
    }

    public static function EOQSemuaProdukAllTime()
    {
        $result = [];

        // Ambil tanggal keluar pertama dari semua produk
        $firstDate = Mutasi::where('jenis', 'keluar')
            ->orderBy('tanggal', 'asc')
            ->value('tanggal');

        if (! $firstDate) {
            return []; // Tidak ada data keluar
        }

        $start = Carbon::parse($firstDate)->startOfMonth();
        $end = Carbon::now()->startOfMonth();
        $current = $start->copy();

        // Ambil semua produk (gunakan model Produk)
        $produkList = Produk::with(['biayaPemesanan', 'biayaPenyimpanan'])->get();

        // Loop semua bulan dari awal sampai sekarang
        while ($current <= $end) {
            foreach ($produkList as $produk) {

                // cek apakah data mencukupi
                if (! PerhitunganEOQServices::hasSufficientSalesData($produk->id, $current)) {
                    // $result[] = [
                    //     'nama_produk' => $produk->nama_produk,
                    //     'periode' => $current->format('Y-m'),
                    // ];

                    continue;
                }

                $EOQ = PerhitunganEOQServices::economicOrderQuantity($produk->id, $current);
                $SS = PerhitunganEOQServices::safetyStock($produk->id, $current);
                $ROP = PerhitunganEOQServices::reorderPoint($produk->id, $current);

                $result[] = [
                    'nama_produk' => $produk->nama_produk,
                    'eoq' => $EOQ,
                    'safety_stock' => $SS,
                    'reorder_point' => $ROP,
                    'periode' => $current->format('Y-m'),
                ];
            }

            $current->addMonth();
        }

        return $result;
    }

    public static function EOQPerBulan($periode)
    {
        $result = [];

        try {
            $periode = Carbon::createFromFormat('Y-m', $periode);
        } catch (\Exception $e) {
            return ['error' => 'Format periode tidak valid. Gunakan format Y-m (contoh: 2024-05).'];
        }

        $produkList = self::with(['biayaPemesanan', 'biayaPenyimpanan'])->get();

        foreach ($produkList as $produk) {

            // cek apakah data mencukupi
            if (! PerhitunganEOQServices::hasSufficientSalesData($produk->id, $periode)) {
                // $result[] = [
                //     'produk' => $produk,
                // ];

                continue;
            }

            $EOQ = PerhitunganEOQServices::economicOrderQuantity($produk->id, $periode);
            $SS = PerhitunganEOQServices::safetyStock($produk->id, $periode);
            $ROP = PerhitunganEOQServices::reorderPoint($produk->id, $periode);

            $result[] = [
                'produk' => $produk,
                'eoq' => $EOQ,
                'safety_stock' => $SS,
                'reorder_point' => $ROP,
            ];
        }

        return $result;
    }

    public function getEconomicOrderQuantityAttribute(): float
    {
        return PerhitunganEOQServices::economicOrderQuantity($this->id);
    }

    public function getSafetyStockAttribute(): float
    {
        return PerhitunganEOQServices::safetyStock($this->id);
    }

    public function getReorderPointAttribute(): float
    {
        return PerhitunganEOQServices::reorderPoint($this->id);

    }

    public function getFrekuensiPemesananAttribute(): int
    {
        return PerhitunganEOQServices::frekuensiPemesanan($this->id);
    }
}
