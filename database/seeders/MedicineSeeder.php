<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('medicines')->insert([
            [
                'category_id' => 1, // Analgesik
                'supplier_id' => 1,
                'name' => 'Paracetamol',
                'generic_name' => 'Acetaminophen',
                'description' => 'Obat untuk menurunkan demam dan meredakan nyeri',
                'price' => 5000.00,
                'unit' => 'Tablet',
                'image' => 'paracetamol.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, // Antibiotik
                'supplier_id' => 2,
                'name' => 'Amoxicillin',
                'generic_name' => 'Amoxicillin trihydrate',
                'description' => 'Antibiotik untuk infeksi saluran pernapasan dan kulit',
                'price' => 7500.00,
                'unit' => 'Kapsul',
                'image' => 'amoxicillin.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3, // Antiseptik
                'supplier_id' => 3,
                'name' => 'Betadine Cair',
                'generic_name' => 'Povidone-iodine',
                'description' => 'Antiseptik untuk luka luar',
                'price' => 12000.00,
                'unit' => 'Botol',
                'image' => 'betadine.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4, // Vitamin
                'supplier_id' => 1,
                'name' => 'Vitamin C 1000mg',
                'generic_name' => 'Ascorbic acid',
                'description' => 'Suplemen penambah daya tahan tubuh',
                'price' => 10000.00,
                'unit' => 'Tablet',
                'image' => 'vitaminc.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
