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
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1, // Analgesik
                'supplier_id' => 2,
                'name' => 'Ibuprofen',
                'generic_name' => 'Ibuprofen',
                'description' => 'Obat antiinflamasi dan pereda nyeri ringan',
                'price' => 8000.00,
                'unit' => 'Tablet',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1, // Analgesik
                'supplier_id' => 1,
                'name' => 'Aspirin',
                'generic_name' => 'Acetylsalicylic Acid',
                'description' => 'Obat pereda nyeri dan penurun demam',
                'price' => 6000.00,
                'unit' => 'Tablet',
                'image' => null,
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
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2, // Antibiotik
                'supplier_id' => 3,
                'name' => 'Cefixime',
                'generic_name' => 'Cefixime trihydrate',
                'description' => 'Antibiotik untuk infeksi saluran kemih dan pernapasan',
                'price' => 15000.00,
                'unit' => 'Kapsul',
                'image' => null,
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
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3, // Antiseptik
                'supplier_id' => 1,
                'name' => 'Alcohol 70%',
                'generic_name' => 'Ethanol 70%',
                'description' => 'Cairan antiseptik untuk membersihkan luka dan tangan',
                'price' => 5000.00,
                'unit' => 'Botol',
                'image' => null,
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
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4, // Vitamin
                'supplier_id' => 2,
                'name' => 'Vitamin D3 1000 IU',
                'generic_name' => 'Cholecalciferol',
                'description' => 'Suplemen untuk kesehatan tulang',
                'price' => 12000.00,
                'unit' => 'Tablet',
                'image' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
