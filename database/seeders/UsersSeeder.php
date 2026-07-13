<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'vikyurbanvibe@gmail.com'],
            [
                'name' => 'Admin Urban Vibe',
                'phone' => '081234567890',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        DB::table('users')->insertOrIgnore([
            [
                'id' => 3, 'name' => 'viky', 'email' => 'viky@urbanvibe',
                'role' => 'customer', 'password' => '$2y$12$Z6bVRTqTgSBpY4zT3K6e8.GNloQ6Qm/4aNXA8EaJHgLhoMRFrigvm',
                'created_at' => '2026-06-10 01:04:57', 'updated_at' => '2026-06-10 01:04:57'
            ],
            [
                'id' => 4, 'name' => 'viky', 'email' => 'viky@urbanvibe.com',
                'role' => 'customer', 'password' => '$2y$12$31g5XJiZeqzcy9wYIzUn1ejm9WYj9gl7Gw42Tnlw0CsFHf9.Aj27S',
                'created_at' => '2026-06-11 01:02:09', 'updated_at' => '2026-06-11 01:02:09'
            ]
        ]);
    }
}
