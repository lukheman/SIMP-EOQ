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

        $data = [
            [
                'nama_produk' => 'Indomie Goreng Soto',
                'kode_produk' => '5285000390596',
                'persediaan' => 300,
                'harga_beli' => 6000.00,
                'harga_jual' => 9000.00,
                'lead_time' => 5,
                'biaya_penyimpanan' => 100000.00,
                'biaya_pemesanan' => 900000.00,
                'deskripsi' => 'Gula Pasir dengan kemasan 1 kg.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Tepung Terigu',
                'kode_produk' => '2616885672904',
                'persediaan' => 300,
                'harga_beli' => 10000.00,
                'harga_jual' => 12000.00,
                'lead_time' => 5,
                'biaya_penyimpanan' => 30000.00,
                'biaya_pemesanan' => 75000.00,
                'deskripsi' => 'Tepung Terigu dengan kemasan 1 kg.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('produk')->insert($data);
    }
}
