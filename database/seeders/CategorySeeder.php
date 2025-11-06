<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Analgesik', 'description' => 'Obat pereda nyeri', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antibiotik', 'description' => 'Obat untuk infeksi bakteri', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Antiseptik', 'description' => 'Obat pembersih luka', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vitamin', 'description' => 'Suplemen penambah daya tahan tubuh', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
