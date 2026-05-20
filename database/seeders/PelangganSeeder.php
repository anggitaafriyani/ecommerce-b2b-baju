<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pelanggans')->insert([
            [
                'nama_toko' => 'Grosir Baju Makmur Bengkulu',
                'nama_pemilik' => 'Awin Wijaya',
                'email' => 'makmurbaju@grosir.com',
                'password' => Hash::make('password123'),
                'no_hp' => '081234567890',
                'alamat_lengkap' => 'Jl. KZ Abidin No. 12, Kota Bengkulu',
                'tipe_mitra' => 'distributor',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_toko' => 'Butik Gaya Remaja',
                'nama_pemilik' => 'Risti Michellia',
                'email' => 'gayaremaja@retail.com',
                'password' => Hash::make('password123'),
                'no_hp' => '089876543210',
                'alamat_lengkap' => 'Jl. P. Natadirja No. 45, Kota Bengkulu',
                'tipe_mitra' => 'toko_retail',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}