<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('address')->insert([
            [
                'id_user' => 1,
                'Kecamatan' => 'Jl. Raya No. 123',
                'provinsi' => 'DKI Jakarta',
                'Kabupaten' => 'Jakarta Barat',
                'Kelurahan' => 'Kelurahan Kebon Jeruk',
                'Kode_pos' => '12345',
                'alamat_lengkap' => 'Jl. Raya No. 123, Kebon Jeruk, Jakarta Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'Kecamatan' => 'Jl. Kebon Jeruk No. 456',
                'Kelurahan' => 'Kelurahan Kebon Jeruk',
                'provinsi' => 'DKI Jakarta',
                'Kabupaten' => 'Jakarta Barat',
                'Kode_pos' => '67890',
                'alamat_lengkap' => 'Jl. Kebon Jeruk No. 456, Kebon Jeruk, Jakarta Barat',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
