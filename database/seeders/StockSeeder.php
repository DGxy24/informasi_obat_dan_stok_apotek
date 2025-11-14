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
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 2,
                'quantity' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 3,
                'quantity' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 4,
                'quantity' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 5,
                'quantity' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 6,
                'quantity' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 7,
                'quantity' => 45,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'medicine_id' => 8,
                'quantity' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}