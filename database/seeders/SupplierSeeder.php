<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'PT Kimia Farma',
                'contact_person' => 'Andi Setiawan',
                'phone' => '081234567890',
                'address' => 'Jl. Gatot Subroto No. 12, Jakarta',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PT Indofarma',
                'contact_person' => 'Budi Santoso',
                'phone' => '081345678901',
                'address' => 'Jl. Merdeka No. 45, Bandung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'CV Sehat Bersama',
                'contact_person' => 'Rina Marlina',
                'phone' => '081289765432',
                'address' => 'Jl. Diponegoro No. 22, Medan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
