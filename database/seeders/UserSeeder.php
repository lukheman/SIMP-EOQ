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
        $roles = ['reseller', 'admin_toko', 'admin_gudang', 'pemilik_toko', 'kurir'];

        foreach ($roles as $role) {
            DB::table('users')->insert([
                'username' => $role,
                'email' => $role . '@example.com',
                'password' => Hash::make('password123'), // Gunakan hashing untuk keamanan
                'role' => $role,
                'name' => 'Akmal ' . $role,
                'phone' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
