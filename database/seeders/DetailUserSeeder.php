<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_user')->insert([
            'id_user' => 1,
            'name' => 'Fuad Grimaldi',
            'age' => '20',
            'gender' => 'Male',
            'contact' => '08123456789',
            'job' => 'Software Engineer',
            'profile_picture' => 'profile.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
