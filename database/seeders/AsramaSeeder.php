<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AsramaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('asramas')->insert([
            [
                'nama_asrama' => 'Al-Azhar',
                'gedung' => 'Gedung Putri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_asrama' => 'Harvard',
                'gedung' => 'Gedung Putri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_asrama' => 'Cambridge',
                'gedung' => 'Gedung Putri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_asrama' => 'Sevilla',
                'gedung' => 'Gedung Putri',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_asrama' => 'Granada',
                'gedung' => 'Gedung Putra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_asrama' => 'Cordoba',
                'gedung' => 'Gedung Putra',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
