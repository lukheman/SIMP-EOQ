<?php

use App\Http\Controllers\KurirController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTokoController;
use App\Http\Controllers\AdminGudangController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\PemilikTokoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\PesananController;

use Illuminate\Support\Facades\Route;

Route::middleware(['role:reseller'])->group(function() {
    Route::controller(ResellerController::class)->group(function() {
        Route::get('reseller', 'index')->name('reseller.index');
        Route::get('reseller/dashboard', 'index')->name('reseller.dashboard');
        Route::get('reseller/katalog', 'katalog')->name('reseller.katalog');
        Route::get('reseller/keranjang', 'keranjang')->name('reseller.keranjang');
        Route::get('reseller/pesanan', 'pesanan')->name('reseller.pesanan');
        Route::get('reseller/pengiriman', 'pengiriman')->name('reseller.pengiriman');

    });
});

Route::middleware(['role:admin_toko'])->group(function() {
    Route::controller(AdminTokoController::class)->group(function() {
        Route::get('admintoko', 'index')->name('admintoko.index');
        Route::get('admintoko/dashboard', 'index')->name('admintoko.dashboard');
        Route::get('admintoko/pesanan', 'pesanan')->name('admintoko.pesanan');
        Route::get('admintoko/persediaan', 'persediaan')->name('admintoko.persediaan');
        Route::post('admintoko/nota', 'nota')->name('admintoko.nota');

        Route::get('admintoko/laporan-penjualan', 'laporanPenjualan')->name('admintoko.laporan-penjualan');
        Route::post('admintoko/cetak-laporan-penjualan', 'cetakLaporanPenjualan')->name('admintoko.cetak-laporan-penjualan');
    });
});

Route::middleware(['role:admin_gudang'])->group(function() {
    Route::controller(AdminGudangController::class)->group(function() {
        Route::get('admingudang', 'index')->name('admingudang.index');
        Route::get('admingudang/dashboard', 'index')->name('admingudang.dashboard');
        Route::get('admingudang/persediaan', 'persediaan')->name('admingudang.persediaan');
        Route::get('admingudang/produk', 'produk')->name('admingudang.produk');

        Route::get('admingudang/eoq', 'eoq')->name('admingudang.eoq');
        Route::post('admingudang/hitung', 'hitung')->name('admingudang.hitung');

        Route::get('admingudang/pesanan', 'pesanan')->name('admingudang.pesanan');

        Route::get('admingudang/barang-masuk', 'barangMasuk')->name('admingudang.barang-masuk');

        Route::get('admingudang/laporan-barang-masuk', 'laporanBarangMasuk')->name('admingudang.laporan-barang-masuk');
        Route::post('admingudang/cetak-laporan-barang-masuk', 'cetakLaporanBarangMasuk')->name('admingudang.cetak-laporan-barang-masuk');

        Route::get('admingudang/laporan-penjualan', 'laporanPenjualan')->name('admingudang.laporan-penjualan');
        Route::post('admingudang/cetak-laporan-penjualan', 'cetakLaporanPenjualan')->name('admingudang.cetak-laporan-penjualan');
    });
});


Route::middleware(['role:pemilik_toko'])->group(function() {
    Route::controller(PemilikTokoController::class)->group(function() {
        Route::get('pemiliktoko', 'index')->name('pemiliktoko.index');
        Route::get('pemiliktoko/dashboard', 'index')->name('pemiliktoko.dashboard');

        Route::get('pemiliktoko/laporan-penjualan', 'laporanPenjualan')->name('pemiliktoko.laporan-penjualan');
        Route::post('pemiliktoko/cetak-laporan-penjualan', 'cetakLaporanPenjualan')->name('pemiliktoko.cetak-laporan-penjualan');

        Route::get('pemiliktoko/laporan-persediaan-produk', 'laporanPersediaanProduk')->name('pemiliktoko.laporan-persediaan-produk');
        Route::get('pemiliktoko/cetak-laporan-persediaan-produk', 'cetakLaporanPersediaanProduk')->name('pemiliktoko.cetak-laporan-persediaan-produk');

        Route::get('pemiliktoko/laporan-barang-masuk', 'laporanBarangMasuk')->name('pemiliktoko.laporan-barang-masuk');
        Route::post('pemiliktoko/cetak-laporan-barang-masuk', 'cetakLaporanBarangMasuk')->name('pemiliktoko.cetak-laporan-barang-masuk');
    });
});

Route::middleware(['role:kurir'])->group(function() {
    Route::controller(KurirController::class)->group(function() {
        Route::get('kurir', 'index')->name('kurir.index');
        Route::get('kurir/dashboard', 'index')->name('kurir.dashboard');
        Route::get('kurir/pesanan', 'pesanan')->name('kurir.pesanan');
        Route::get('kurir/konfirmasiPembayaran', 'scanQrcode')->name('kurir.scan-qrcode');
        Route::post('kurir/konfirmasiPembayaran', 'konfirmasiPembayaran')->name('kurir.konfirmasi-pembayaran');
    });
});

Route::controller(ProdukController::class)->group(function() {
    Route::get('produk/all', 'all')->name('produk.all');
});

Route::resource('produk', ProdukController::class)->only(['store', 'update', 'destroy', 'show']);
Route::resource('pesanan', PesananController::class)->only(['store', 'update', 'destroy', 'show']);
Route::controller(PesananController::class)->group(function() {
    Route::post('pesanan/checkout', 'checkout')->name('pesanan.checkout');
});

Route::resource('persediaan', PersediaanController::class)->only(['store', 'update', 'destroy', 'show']);

Route::resource('transaksi', TransaksiController::class)->only(['store', 'update', 'destroy', 'show']);

Route::controller(TransaksiController::class)->group(function() {
    Route::post('transaksi/detail', 'detail')->name('transaksi.detail');
});

// Route::resource('penjualan', PenjualanController::class)->only(['store', 'destroy', 'show']);
Route::resource('mutasi', MutasiController::class)->only(['store', 'update', 'destroy', 'show',]);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'index'])->name('Dashboard');
