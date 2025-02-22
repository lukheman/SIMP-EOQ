<?php

use App\Http\Controllers\KurirController;
use App\Http\Controllers\PersediaanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminTokoController;
use App\Http\Controllers\AdminGudangController;
use App\Http\Controllers\ResellerController;
use App\Http\Controllers\PemilikTokoController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\TransaksiController;

use Illuminate\Support\Facades\Route;

Route::controller(AdminTokoController::class)->group(function() {
    Route::get('admintoko', 'index')->name('admintoko.index');
    Route::get('admintoko/dashboard', 'index')->name('admintoko.dashboard');
    Route::get('admintoko/pesanan', 'pesanan')->name('admintoko.pesanan');
});

Route::controller(AdminGudangController::class)->group(function() {
    Route::get('admingudang', 'index')->name('admingudang.index');
    Route::get('admingudang/dashboard', 'index')->name('admingudang.dashboard');
    Route::get('admingudang/log-persediaan', 'logPersediaan')->name('admingudang.log-persediaan');
    Route::get('admingudang/persediaan', 'persediaan')->name('admingudang.persediaan');
    Route::get('admingudang/data-produk', 'dataProduk')->name('admingudang.data-produk');
    Route::get('admingudang/eoq', 'eoq')->name('admingudang.eoq');
    Route::get('admingudang/hitung-eoq', 'hitungEOQ')->name('admingudang.hitung-eoq');
    Route::get('admingudang/pesanan', 'pesanan')->name('admingudang.pesanan');
});

Route::controller(ResellerController::class)->group(function() {
    Route::get('reseller', 'index')->name('reseller.index');
    Route::get('reseller/dashboard', 'index')->name('reseller.dashboard');
    Route::get('reseller/katalog', 'katalog')->name('reseller.katalog');
    Route::get('reseller/pesanan', 'pesanan')->name('reseller.pesanan');
    Route::get('reseller/pengiriman', 'pengiriman')->name('reseller.pengiriman');
});

Route::controller(PemilikTokoController::class)->group(function() {
    Route::get('pemiliktoko', 'index')->name('pemiliktoko.index');
    Route::get('pemiliktoko/dashboard', 'index')->name('pemiliktoko.dashboard');
});

Route::controller(KurirController::class)->group(function() {
    Route::get('kurir', 'index')->name('kurir.index');
    Route::get('kurir/dashboard', 'index')->name('kurir.dashboard');
    Route::get('kurir/konfirmasiPembayaran', 'konfirmasiPembayaran')->name('kurir.konfirmasi-pembayaran');
});

Route::controller(ProdukController::class)->group(function() {
    Route::get('produk/all', 'all')->name('produk.all');
});
Route::resource('produk', ProdukController::class)->only(['store', 'update', 'destroy', 'show']);

Route::resource('persediaan', PersediaanController::class)->only(['store', 'update', 'destroy', 'show']);

Route::resource('transaksi', TransaksiController::class)->only(['store', 'update', 'destroy', 'show']);

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'index'])->name('Dashboard');
