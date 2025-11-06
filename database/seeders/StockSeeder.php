<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('stocks')->insert([
            [
                'medicine_id' => 1,
                'quantity' => 100,
                'type' => 'in',
                'reference' => 'Pembelian awal',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 2,
                'quantity' => 80,
                'type' => 'in',
                'reference' => 'Stok baru',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 3,
                'quantity' => 50,
                'type' => 'in',
                'reference' => 'Pembelian dari supplier',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 4,
                'quantity' => 40,
                'type' => 'out',
                'reference' => 'Penjualan',
                'date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
