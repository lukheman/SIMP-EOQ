<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersediaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('persediaan')->insert([
            // [
            //     'id_produk' => 1,
            //     'stock' => 100,
            //     'stock_min' => 20,
            //     'stock_max' => 200,
            //     'lead_time' => 5,
            //     'reorder_point' => 50,
            //     'safety_stock' => 10,
            //     'eoq' => 80,
            //     'rata_rata_penggunaan' => 30,
            //     'biaya_penyimpanan' => 5000.00,
            //     'biaya_pemesanan' => 15000.00,
            //     'pembelian' => 0,
            //     'penggunaan' => 0,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            // [
            //     'id_produk' => 2,
            //     'stock' => 150,
            //     'stock_min' => 30,
            //     'stock_max' => 250,
            //     'lead_time' => 4,
            //     'reorder_point' => 60,
            //     'safety_stock' => 15,
            //     'eoq' => 90,
            //     'rata_rata_penggunaan' => 40,
            //     'biaya_penyimpanan' => 6000.00,
            //     'biaya_pemesanan' => 12000.00,
            //     'pembelian' => 0,
            //     'penggunaan' => 0,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            // [
            //     'id_produk' => 3,
            //     'stock' => 200,
            //     'stock_min' => 40,
            //     'stock_max' => 300,
            //     'lead_time' => 3,
            //     'reorder_point' => 70,
            //     'safety_stock' => 20,
            //     'eoq' => 100,
            //     'rata_rata_penggunaan' => 50,
            //     'biaya_penyimpanan' => 7000.00,
            //     'biaya_pemesanan' => 10000.00,
            //     'pembelian' => 0,
            //     'penggunaan' => 0,
            //     'created_at' => now(),
            //     'updated_at' => now()
            // ],
            [
                'id_produk' => 6,
                // 'stock' => 280,
                'periode' => '2025-10',
                // 'stock_min' => 40,
                // 'stock_max' => 300,
                'lead_time' => 5,
                'reorder_point' => 0,
                'safety_stock' => 0,
                'eoq' => 0,
                'rata_rata_penggunaan' => 5,
                'biaya_penyimpanan' => 100000.00,
                'biaya_pemesanan' => 900000.00,
                'pembelian' => 140,
                'penggunaan' => 120,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_produk' => 6,
                // 'stock' => 280,
                'periode' => '2025-11',
                // 'stock_min' => 40,
                // 'stock_max' => 300,
                'lead_time' => 5,
                'reorder_point' => 0,
                'safety_stock' => 0,
                'eoq' => 0,
                'rata_rata_penggunaan' => 5,
                'biaya_penyimpanan' => 100000.00,
                'biaya_pemesanan' => 900000.00,
                'pembelian' => 140,
                'penggunaan' => 130,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
