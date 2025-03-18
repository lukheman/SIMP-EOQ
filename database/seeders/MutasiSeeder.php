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
                'id_produk' => 3,
                'tanggal' => "2025-01-01",
                'jumlah' => 50,
                'jenis' => 'keluar'
            ],
            [ 
                'id_produk' => 3,
                'tanggal' => "2025-01-10",
                'jumlah' => 50,
                'jenis' => 'keluar'
            ],
            [ 
                'id_produk' => 3,
                'tanggal' => "2025-01-20",
                'jumlah' => 20,
                'jenis' => 'keluar'
            ],
            [ 
                'id_produk' => 3,
                'tanggal' => "2025-02-10",
                'jumlah' => 65,
                'jenis' => 'keluar'
            ],
            [ 
                'id_produk' => 3,
                'tanggal' => "2025-02-10",
                'jumlah' => 65,
                'jenis' => 'keluar'
            ],

        ]);

        /* DB::table('mutasi')->insert([ */
        /*     [ */
        /*         'id_produk' => 1, */
        /*         'tanggal' => date("Y-m-d"), */
        /*         'jumlah' => 10, */
        /*         'jenis' => 'keluar' */
        /*     ], */
        /*     [ */
        /*         'id_produk' => 2, */
        /*         'tanggal' => date("Y-m-d"), */
        /*         'jumlah' => 20, */
        /*         'jenis' => 'keluar' */
        /*     ], */
        /*     [ */
        /*         'id_produk' => 3, */
        /*         'tanggal' => date("Y-m-d"), */
        /*         'jumlah' => 30, */
        /*         'jenis' => 'masuk' */
        /*     ], */
        /*     [ */
        /*         'id_produk' => 4, */
        /*         'tanggal' => date("Y-m-d"), */
        /*         'jumlah' => 5, */
        /*         'jenis' => 'masuk' */
        /*     ], */
        /*     [ */
        /*         'id_produk' => 6, */
        /*         'tanggal' => "2024-10-01", */
        /*         'jumlah' => 140, */
        /*         'jenis' => 'masuk' */
        /*     ], */
        /*     [ */
        /*         'id_produk' => 6, */
        /*         'tanggal' => "2024-10-01", */
        /*         'jumlah' => 120, */
        /*         'jenis' => 'keluar' */
        /*     ], */
        /*     [ */
        /*         'id_produk' => 6, */
        /*         'tanggal' => "2024-11-01", */
        /*         'jumlah' => 140, */
        /*         'jenis' => 'masuk' */
        /*     ], */
        /*     [ */
        /*         'id_produk' => 6, */
        /*         'tanggal' => "2024-11-01", */
        /*         'jumlah' => 130, */
        /*         'jenis' => 'keluar' */
        /*     ], */
        /* ]); */
    }
}
