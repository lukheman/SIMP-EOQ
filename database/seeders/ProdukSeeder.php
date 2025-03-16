<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Data use Illuminate\Support\Facades\DB;

        $data = [
            [
                'nama_produk' => 'Laptop ASUS X441UA',
                'kode_produk' => 'LP001',
                'persediaan' => 50,
                'harga_beli' => 5000000.00,
                'harga_jual' => 6000000.00,
                'lead_time' => 7,
                'biaya_penyimpanan' => 50000.00,
                'biaya_pemesanan' => 100000.00,
                'penggunaan_rata_rata' => 5,
                'deskripsi' => 'Laptop ASUS X441UA dengan prosesor Intel Core i3 dan RAM 4GB.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Smartphone Samsung Galaxy A51',
                'kode_produk' => 'SP001',
                'persediaan' => 50,
                'harga_beli' => 3000000.00,
                'harga_jual' => 3500000.00,
                'lead_time' => 5,
                'biaya_penyimpanan' => 30000.00,
                'biaya_pemesanan' => 75000.00,
                'penggunaan_rata_rata' => 5,
                'deskripsi' => 'Smartphone Samsung Galaxy A51 dengan layar 6.5 inci dan kamera 48MP.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Printer Epson L120',
                'kode_produk' => 'PR001',
                'persediaan' => 50,
                'harga_beli' => 1500000.00,
                'harga_jual' => 1800000.00,
                'lead_time' => 10,
                'biaya_penyimpanan' => 20000.00,
                'biaya_pemesanan' => 50000.00,
                'penggunaan_rata_rata' => 5,
                'deskripsi' => 'Printer Epson L120 dengan teknologi Ink Tank System.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Monitor LG 24MK430H',
                'kode_produk' => 'MN001',
                'persediaan' => 40,
                'harga_beli' => 1200000.00,
                'harga_jual' => 1500000.00,
                'lead_time' => 8,
                'biaya_penyimpanan' => 25000.00,
                'biaya_pemesanan' => 60000.00,
                'penggunaan_rata_rata' => 5,
                'deskripsi' => 'Monitor LG 24MK430H dengan layar 24 inci dan resolusi Full HD.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Keyboard Mechanical Rexus Daxa M84',
                'kode_produk' => 'KB001',
                'persediaan' => 30,
                'harga_beli' => 400000.00,
                'harga_jual' => 500000.00,
                'lead_time' => 3,
                'biaya_penyimpanan' => 10000.00,
                'biaya_pemesanan' => 30000.00,
                'penggunaan_rata_rata' => 5,
                'deskripsi' => 'Keyboard Mechanical Rexus Daxa M84 dengan switch Outemu Blue.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Mie Instan Intermi Soto',
                'kode_produk' => 'MKN001',
                'persediaan' => 20,
                'harga_beli' => 60000.00,
                'harga_jual' => 70000.00,
                'lead_time' => 5,
                'biaya_penyimpanan' => 100000.00,
                'biaya_pemesanan' => 900000.00,
                'penggunaan_rata_rata' => 5,
                'deskripsi' => 'Indomie Enak',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('produk')->insert($data);
    }
}
