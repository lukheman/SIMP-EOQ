<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        date_default_timezone_set("Asia/Jakarta");

        DB::table('penjualan')->insert([
            [
                'id_produk' => 1,
                'tanggal' => date("Y-m-d"),
                'jumlah' => 10,
                'total_harga' => 10000,
            ],
            [
                'id_produk' => 2,
                'tanggal' => date("Y-m-d"),
                'jumlah' => 20,
                'total_harga' => 50000,
            ]
        ]);
    }
}
