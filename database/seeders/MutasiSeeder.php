<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MutasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        date_default_timezone_set("Asia/Jakarta");

        DB::table('mutasi')->insert([
            [
                'id_produk' => 1,
                'tanggal' => date("Y-m-d"),
                'jumlah' => 10,
                'jenis' => 'keluar'
            ],
            [
                'id_produk' => 2,
                'tanggal' => date("Y-m-d"),
                'jumlah' => 20,
                'jenis' => 'keluar'
            ]
        ]);
    }
}
