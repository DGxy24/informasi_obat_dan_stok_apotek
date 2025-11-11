<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cek apakah admin sudah ada
        $adminExists = DB::table('users')->where('username', 'admin')->exists();
        
        if (!$adminExists) {
            DB::table('users')->insert([
                'name' => 'Administrator',
                'email' => 'admin@apoteksehatssentosa.com',
                'phone' => '08123456789',
                'username' => 'admin',
                'password' => Hash::make('admin123'), // Password: admin123
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            
            echo "✅ Admin berhasil dibuat!\n";
            echo "Username: admin\n";
            echo "Password: admin123\n";
        } else {
            echo "ℹ️  Admin sudah ada di database.\n";
        }
        
        // Buat beberapa user dummy
        $users = [
            [
                'name' => 'User Test 1',
                'email' => 'user1@test.com',
                'phone' => '08111111111',
                'username' => 'user1',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
            [
                'name' => 'User Test 2',
                'email' => 'user2@test.com',
                'phone' => '08222222222',
                'username' => 'user2',
                'password' => Hash::make('password123'),
                'role' => 'user',
            ],
        ];
        
        foreach ($users as $user) {
            $exists = DB::table('users')->where('username', $user['username'])->exists();
            if (!$exists) {
                DB::table('users')->insert(array_merge($user, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ]));
            }
        }
        
        echo "✅ User dummy berhasil dibuat!\n";
    }
}