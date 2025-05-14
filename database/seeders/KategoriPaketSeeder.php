<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriPaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert data kategori_pakets
        DB::table('kategori_pakets')->insert([
            ['nama_kategori' => 'Makanan Basah'],
            ['nama_kategori' => 'Makanan Kering (Snack)'],
            ['nama_kategori' => 'Non Makanan'],
        ]);
    }
}
