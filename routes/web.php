<?php

use App\Http\Controllers\KurirController;
use App\Http\Controllers\LaporanController;
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
use App\Http\Controllers\RestockController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

Route::get('/registrasi', [AuthController::class, 'registrasi'])->name('reseller.registrasi');
Route::post('/signup', [AuthController::class, 'signup'])->name('reseller.signup');

Route::resource('profile', ProfileController::class)->only(['index', 'update'])->middleware('auth');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/dashboard', [AuthController::class, 'index'])->name('Dashboard');

Route::middleware(['role:reseller', 'auth'])->group(function() {
    Route::controller(ResellerController::class)->group(function() {
        Route::get('reseller', 'index')->name('reseller.index');
        Route::get('reseller/dashboard', 'index')->name('reseller.dashboard');
        Route::get('reseller/katalog', 'katalog')->name('reseller.katalog');
        Route::get('reseller/keranjang', 'keranjang')->name('reseller.keranjang');
        Route::get('reseller/transaksi', 'transaksi')->name('reseller.transaksi');
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
    });
});

Route::middleware(['role:admin_gudang', 'auth'])->group(function() {
    Route::controller(AdminGudangController::class)->group(function() {
        Route::get('admingudang', 'index')->name('admingudang.index');
        Route::get('admingudang/dashboard', 'index')->name('admingudang.dashboard');

        Route::get('admingudang/produk', 'produk')->name('admingudang.produk');
        Route::get('admingudang/produk/persediaan', 'persediaan')->name('admingudang.produk.persediaan');
        Route::get('admingudang/produk/biaya-pemesanan', 'biayaPemesanan')->name('admingudang.produk.biaya-pemesanan');
        Route::get('admingudang/produk/biaya-penyimpanan', 'biayaPenyimpanan')->name('admingudang.produk.biaya-penyimpanan');


        Route::get('admingudang/eoq', 'eoq')->name('admingudang.eoq');
        Route::post('admingudang/hitung', 'hitung')->name('admingudang.hitung');

        Route::get('admingudang/pesanan', 'pesanan')->name('admingudang.pesanan');

        Route::get('admingudang/barang-masuk', 'barangMasuk')->name('admingudang.barang-masuk');

        Route::get('admingudang/laporan-barang-masuk', 'laporanBarangMasuk')->name('admingudang.laporan-barang-masuk');

        Route::get('admingudang/laporan-penjualan', 'laporanPenjualan')->name('admingudang.laporan-penjualan');

        Route::get('admingudang/scan-barang-masuk', 'scanBarangMasuk')->name('admingudang.scan-barang-masuk');
    });
});


Route::middleware(['role:pemilik_toko'])->group(function() {
    Route::controller(PemilikTokoController::class)->group(function() {
        Route::get('pemiliktoko', 'index')->name('pemiliktoko.index');
        Route::get('pemiliktoko/dashboard', 'index')->name('pemiliktoko.dashboard');

        Route::get('pemiliktoko/laporan-penjualan', 'laporanPenjualan')->name('pemiliktoko.laporan-penjualan');

        Route::get('pemiliktoko/laporan-persediaan-produk', 'laporanPersediaanProduk')->name('pemiliktoko.laporan-persediaan-produk');

        Route::get('pemiliktoko/laporan-barang-masuk', 'laporanBarangMasuk')->name('pemiliktoko.laporan-barang-masuk');
    });
});

Route::middleware(['role:kurir'])->group(function() {
    Route::controller(KurirController::class)->group(function() {
        Route::get('kurir', 'index')->name('kurir.index');
        Route::get('kurir/dashboard', 'index')->name('kurir.dashboard');
        Route::get('kurir/pesanan', 'pesanan')->name('kurir.pesanan');
        Route::get('kurir/konfirmasi-pembayaran', 'konfirmasiPembayaranPage')->name('kurir.konfirmasi-pembayaran-page');
        Route::post('kurir/konfirmasi-pembayaran/{id}', 'konfirmasiPembayaran')->name('kurir.konfirmasi-pembayaran');
    });
});

Route::resource('produk', ProdukController::class)->only(['store', 'update', 'destroy', 'show', 'index']);
Route::controller(ProdukController::class)->group(function() {
    /* Route::get('produk/all', 'all')->name('produk.all'); */
    Route::get('produk/kode-produk/{code}', 'kodeProduk')->name('produk.kode-produk');
});

Route::resource('pesanan', PesananController::class)->only(['store', 'update', 'destroy', 'show']);
Route::controller(PesananController::class)->group(function() {
    Route::post('pesanan/checkout', 'checkout')->name('pesanan.checkout');
    Route::post('pesanan/destroy-many', 'destroyMany')->name('pesanan.destroy-many');
});

Route::resource('persediaan', PersediaanController::class)->only(['store', 'update', 'destroy', 'show']);

Route::resource('transaksi', TransaksiController::class)->only(['index', 'store', 'update', 'destroy', 'show']);

Route::controller(TransaksiController::class)->group(function() {
    Route::post('transaksi/detail', 'detail')->name('transaksi.detail');
    Route::post('transaksi/bukti-pembayaran/{id}', 'buktiPembayaran')->name('transaksi.bukti-pembayaran');
    Route::post('transaksi/update-status-pembayaran/{id}', 'updateStatusPembayaran')->name('transaksi.update-status-pembayaran');
});

Route::resource('mutasi', MutasiController::class)->only(['store', 'update', 'destroy', 'show',]);

Route::resource('restock', RestockController::class)->only(['store', 'update', 'destroy']);
Route::controller(RestockController::class)->group(function() {
    Route::get('restock/exist/{barcode}', 'exist')->name('restock.exist');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('home');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AuthController::class, 'index'])->name('Dashboard');

Route::post('/laporan/laporan-penjualan', [LaporanController::class, 'laporanPenjualan'])->name('laporan-penjualan');
Route::post('/laporan/laporan-barang-masuk', [LaporanController::class, 'laporanBarangMasuk'])->name('laporan-barang-masuk');
Route::get('/laporan/laporan-persediaan-produk', [LaporanController::class, 'laporanPersediaanProduk'])->name('laporan-persediaan-produk');
