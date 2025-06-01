<?php

namespace Database\Seeders;

use App\Models\Produk;
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
                'harga_beli' => 6000.00,
                'harga_jual' => 9000.00,
                'lead_time' => 5,
                'deskripsi' => 'Gula Pasir dengan kemasan 1 kg.',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nama_produk' => 'Minyak Sabrina',
                'kode_produk' => '2616885672904',
                'harga_beli' => 10000.00,
                'harga_jual' => 12000.00,
                'lead_time' => 1,
                'deskripsi' => 'Tepung Terigu dengan kemasan 1 kg.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach($data as $item) {
            $produk = Produk::create($item);
            $produk->persediaan()->create(['jumlah' => 30]);
            $produk->biayaPemesanan()->create(['biaya' => 900000.00]);
            $produk->biayaPenyimpanan()->create(['biaya' => 100000.00]);
        }


    }
}
