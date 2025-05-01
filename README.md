# username dan password masing-masing role

| username                 | password    |
|--------------------------|-------------|
| admin_gudang@example.com | password123 |
| admin_toko@example.com   | password123 |
| pemilik_toko@example.com | password123 |
| reseller@example.com     | password123 |
| kurir@example.com        | password123 |

# Kebutuhan instalasi

- Laravel Framework 11.42.1
- php 8.2
- composer 2.8.6 (package manager php)

# Menjalankan aplikasi

```
php artisan serve
```

# TODO

## Revisi pertama

- [x] tambahkan rata-rata penjualan harian di laporan penjualan
- [x] mekanisme tambah barang masuk (scanning bar code produk) jika produk belum ada maka tambahkan
- [x] rata-rata penjualan dibuat otomatis
- [x] lead time dibuat otomatis
- [x] tambah metode pembayaran di reseller dan mengirim bukti pembayaran ke admin toko
- [x] reseller dapat memilih pesanan di keranjang untuk dicheckout atau dihapus
- [x] view: table data produk dan barang masuk tambahkan harga barang
- [x] pisahkan table biaya penyimpanan, pemesanan, dan produk
- [x] perbaiki alur pengurangan persediaan barang ketika terjadi pembelian
- [x] EOQ dibuat perbulan

## penjelasan halaman transaksi di role admin toko
- pengrungan barang akan terjadi ketika transaksi diterima

## penjelasan halaman transaksi di role reseller

- secara default halaman akan menampilkan sub halaman belum bayar
- sub halaman Belum Bayar akan menampilkan transaksi dengan metode pembayaran transfer dengan status pembayaran belum bayar
- sub halaman Pending akan menampilkan transaksi dengan status transaksi `pending` (semua metode pembayaran)
- sub halaman Diproses akan menampilkan transaksi dengan status transaksi `diproses` (semua metode pembayaran)
- sub halaman Dikirim akan menampilkan transaksi dengan status transaksi `dikirim` (semua metode pembayaran)
- sub halaman Selesai akan menampilkan transaksi dengan status transaksi `selesai` (semua metode pembayaran)


## penjelasana halaman konfimasi pembayaran pada role kurir
- jika kurir mengonfirmasi pesanan dengan scan-qr maka status transaksi akan berubah menjadi `diterima` dan status pembayaran akan menjadi `lunas` karena kurir telah menerima uang
