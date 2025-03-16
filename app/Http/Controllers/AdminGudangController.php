<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Produk;
use App\Models\Persediaan;
use App\Models\Mutasi;

class AdminGudangController extends Controller
{

    public function index() {
        $total_produk = Produk::count();
        $total_persediaan = Produk::sum('persediaan');

        return view('admin_gudang.index', [
            'page' => 'Dashboard',
            'total_produk' => $total_produk,
            'total_persediaan' => $total_persediaan
        ]);
    }
    
    public function barangMasuk() {
        $barang_masuk = Mutasi::with('produk')->where('jenis', 'masuk')->get();

        return view('admin_gudang.barang-masuk', [
            'page' => 'Barang Masuk',
            'barang_masuk' => $barang_masuk
        ]);
    }

    public function persediaan() {
        $produk = Produk::all();

        return view('admin_gudang.persediaan', [
            'page' => 'Persediaan',
            'produk' => $produk
        ]);
    }

    public function produk() {
        $produk = Produk::all();
        return view('admin_gudang.produk', [
            'page' => 'Produk',
            'produk' => $produk
        ]);
    }


    private function getPM($periode1, $periode2, $id_produk) {
        $periode1 = new DateTime($periode1);
        $periode2 = new DateTime($periode2);

        $penjualanPeriode1 = Mutasi::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode1->format('Y'))
            ->whereMonth('tanggal', $periode1->format('m'))
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        $penjualanPeriode2 = Mutasi::where('id_produk', $id_produk)
            ->whereYear('tanggal', $periode2->format('Y'))
            ->whereMonth('tanggal', $periode2->format('m'))
            ->where('jenis', 'keluar')
            ->sum('jumlah');

        return max($penjualanPeriode1, $penjualanPeriode2);

    }

    private function hitungSafetyStock($PM, $PRR, $LT) {
        return ($PM - $PRR) * $LT;
    }

    private function hitungReorderPoint($SS, $LT, $Q) {
        return $SS + ($LT * $Q);
    }

    private function hitungEconomicOrderQuantity($D, $S, $H) {
        return sqrt((2 * $D * $S) / $H);
    }


    public function hitung(Request $request) {

        $periodeAwal = $request->periode;
        $periodeAkhir = (new DateTime($periodeAwal))->modify('+1 month')->format('Y-m');

        $tanggalAwal = (new DateTime($periodeAwal))->modify('first day of this month')->format('Y-m-d');
        $tanggalAkhir = (new DateTime($periodeAkhir))->modify('last day of this month')->format('Y-m-d');

        $produk = Produk::all();

        foreach($produk as $item) {

            $D = Mutasi::where('id_produk', $item->id)
                ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
                ->where('jenis', 'keluar')
                ->sum('jumlah');

            if($D <= 0) {
                continue;
            } 

            $S = $item->biaya_pemesanan; // biaya pemesanan
            $H = $item->biaya_penyimpanan; // biaya penyimpanan
            $LT = $item->lead_time; // waktu tunggu
            $Q = $item->rata_rata_penggunaan; // penggunaan rata-rata
            $PRR = $D / 2; // penjualan rata-rata dibagi 2 karena dihitung dari 2 periode

            $PM = $this->getPM($periodeAwal, $periodeAkhir, $item->id); // penjualan maksimum

            $EOQ = $this->hitungEconomicOrderQuantity($D, $S, $H);

            $SS = $this->hitungSafetyStock($PM, $PRR, $LT);

            $ROP = $this->hitungReorderPoint($SS, $LT, $Q);

            $item->eoq = round($EOQ);
            $item->ss = $SS;
            $item->rop = $ROP;
            $item->pm = $PM;
            $item->biaya_pemesanan = $S;
            $item->biaya_penyimpanan = $H;

        }


        return view('admin_gudang.eoq', [
            'page' => 'EOQ',
            'produk' => $produk
        ]);

    }

    public function eoq() {

        return view('admin_gudang.eoq', [
            'page' => 'EOQ',
        ]);
    }

    public function laporanPenjualan() {
        $penjualan = Mutasi::where('jenis', 'keluar')->get();

        return view('admin_gudang.laporan-penjualan', [
            'page' => 'Laporan Penjualan',
            'penjualan' => $penjualan
        ]);
    }

    public function cetakLaporanPenjualan(Request $request) {
        $request->validate([
            'periode' => 'required'
        ]);

        list($tahun, $bulan) = explode('-', $request->periode);

        $penjualan = Mutasi::with('produk')
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('jenis', 'keluar')
            ->get();

        return view('invoices.laporan-penjualan', [
            'penjualan' => $penjualan,
            'periode' => $request->periode,
            'ttd' => 'Kepala Gudang'
        ]);
    }

    public function laporanBarangMasuk() {
        $barang_masuk = Mutasi::with('produk')->where('jenis', 'masuk')->get();

        return view('admin_gudang.laporan-barang-masuk', [
            'page' => 'Laporan Barang Masuk',
            'barang_masuk' => $barang_masuk
        ]);
    }

    public function cetakLaporanBarangMasuk(Request $request) {

        $request->validate([
            'periode' => 'required'
        ]);

        list($tahun, $bulan) = explode('-', $request->periode);

        $barang_masuk = Mutasi::with('produk')
            ->whereYear('tanggal', $tahun)
            ->whereMonth('tanggal', $bulan)
            ->where('jenis', 'masuk')
            ->get();

        return view('invoices.laporan-barang-masuk', [
            'barang_masuk' => $barang_masuk,
            'periode' => $request->periode,
            'ttd' => 'Kepala Gudang'
        ]);
    }


}
