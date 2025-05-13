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

    public function biayaPemesanan() {
        return $this->hasOne(BiayaPemesanan::class, 'id_produk');
    }

    public function biayaPenyimpanan() {
        return $this->hasOne(BiayaPenyimpanan::class, 'id_produk');
    }

    public function isPersediaanMencukupi(int $permintaan): bool
    {
        return $this->persediaan->jumlah >= $permintaan;
    }

    public static function EOQPerBulan($periode) {
        $result = [];

        // Pastikan format input valid
        try {
            $tanggal = Carbon::createFromFormat('Y-m', $periode)->startOfMonth();
        } catch (\Exception $e) {
            return ['error' => 'Format periode tidak valid. Gunakan format Y-m (contoh: 2024-05).'];
        }

        // Ambil semua produk dengan relasi biaya
        $produkList = Produk::with(['biayaPemesanan', 'biayaPenyimpanan'])->get();

        foreach ($produkList as $produk) {
            $D = Mutasi::where('id_produk', $produk->id)
                ->where('jenis', 'keluar')
                ->whereYear('tanggal', $tanggal->year)
                ->whereMonth('tanggal', $tanggal->month)
                ->sum('jumlah');

            $S = optional($produk->biayaPemesanan)->biaya ?? 0;
            $H = optional($produk->biayaPenyimpanan)->biaya ?? 1;

            $EOQ = $D > 0 ? round(sqrt((2 * $D * $S) / $H), 2) : 0;

            $PM = Mutasi::penjualanMaksimum($produk->id, $tanggal); // penjualan maksimum
            $PRR = $D / 4; // penjualan rata-rata dibagi 4 (perminggu)
            $LT = $produk->lead_time; // waktu tunggu

            $SS = ($PM - $PRR) * $LT;

            $Q = Mutasi::rataRataPenjualan($produk->id, $tanggal) ?? 0;
            $ROP = round($SS + ($LT * $Q), 2);

            $result[] = [
                'produk' => $produk,
                'eoq' => $EOQ,
                'safety_stock' => $SS,
                'reorder_point' => $ROP,
            ];
        }

        return $result;
    }


    public static function EOQSemuaProdukAllTime() {
        $result = [];

        // Ambil tanggal keluar pertama dari semua produk
        $firstDate = Mutasi::where('jenis', 'keluar')
            ->orderBy('tanggal', 'asc')
            ->value('tanggal');

        if (!$firstDate) {
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
                $D = Mutasi::where('id_produk', $produk->id)
                    ->where('jenis', 'keluar')
                    ->whereYear('tanggal', $current->year)
                    ->whereMonth('tanggal', $current->month)
                    ->sum('jumlah');

                $S = optional($produk->biayaPemesanan)->biaya ?? 0;
                $H = optional($produk->biayaPenyimpanan)->biaya ?? 1;

                $EOQ = $D > 0 ? round(sqrt((2 * $D * $S) / $H), 2) : 0;

                $PM = Mutasi::penjualanMaksimum($produk->id, $current); // penjualan maksimum
                $PRR = $D / 4; // penjualan rata-rata dibagi 4 (perminggu)
                $LT = $produk->lead_time; // waktu tunggu

                $SS = ($PM - $PRR) * $LT;

                $Q = Mutasi::rataRataPenjualan($produk->id, $current) ?? 0;
                $ROP = round($SS + ($LT * $Q), 2);

                $result[] = [
                    'nama_produk' => $produk->nama_produk,
                    'eoq' => $EOQ,
                    'safety_stock' => $SS,
                    'reorder_point' => $ROP,
                    'periode' => $current->format('Y-m')
                ];
            }

            $current->addMonth();
        }

        return $result;
    }

    public function economicOrderQuantity() {

        $periode = Carbon::now()->subMonth(); // bulan lalu

        $D = Mutasi::where('id_produk', $this->id)
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $S = $this->biayaPemesanan->biaya;
        $H = $this->biayaPenyimpanan->biaya;

        return round(sqrt((2 * $D * $S) / $H), 2);

    }


    public function safetyStock($submonth = 1) {

        $periode = Carbon::now()->subMonth($submonth); // bulan lalu

        $D = Mutasi::where('id_produk', $this->id)
            ->whereYear('tanggal', $periode->year)
            ->whereMonth('tanggal', $periode->month)
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $PM = Mutasi::penjualanMaksimum($this->id, $periode); // penjualan maksimum
        $PRR = $D / 4; // penjualan rata-rata dibagi 4 (perminggu)
        $LT = $this->lead_time; // waktu tunggu

        return ($PM - $PRR) * $LT;
    }

    public function reorderPoint() {

        $SS = $this->safetyStock();
        $LT = $this->lead_time; // waktu tunggu
        $Q = Mutasi::rataRataPenjualan($this->id, Carbon::now()->subMonth());
        return round($SS + ($LT * $Q), 2);
    }


}
