<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Daftar role dengan nama berbeda untuk setiap role
        $roles = [
            'reseller' => 'Marcus',
            'reseller' => 'Citra',
            'admin_toko' => 'Nuruddin',
            'admin_gudang' => 'Madun',
            'pemilik_toko' => 'Hendri',
            'kurir' => 'Ihwan',
        ];

        // Menyisipkan data ke tabel 'users'
        foreach ($roles as $role => $name) {
            DB::table('users')->insert([
                /* 'username' => $role, */
                'email' => $role . '@example.com',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => $role,
                'name' => $name, // Nama sesuai dengan role
                'phone' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Menyisipkan data ke tabel 'reseller_detail' untuk id_user 1
        DB::table('reseller_detail')->insert([
            'id_user' => 1,
            'alamat' => 'Depan gerbang utama kampus USN'
        ]);
    }
}
