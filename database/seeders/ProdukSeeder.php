<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'id' => 'IC0001',
                'nama' => 'Incube 1',
                'tinggi' => 100,
                'lebar' => 50,
                'kapasitas' => 200,
                'telur' => 100,
                'pass_access' => str::random(10),
                'price' => 100000,
                'image' => 'image1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'IC0002',
                'nama' => 'Incube 2',
                'tinggi' => 200,
                'lebar' => 10,
                'kapasitas' => 400,
                'telur' => 100,
                'pass_access' => str::random(10),
                'price' => 200000,
                'image' => 'image1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'IC0003',
                'name' => 'Incube 3',
                'tinggi' => 140,
                'lebar' => 80,
                'kapasitas' => 160,
                'telur' => 50,
                'pass_access' => str::random(10),
                'price' => 90000,
                'image' => 'image1.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
