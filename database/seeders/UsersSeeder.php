<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 3, 'name' => 'viky', 'email' => 'viky@urbanvibe',
                'role' => 'customer', 'password' => '$2y$12$Z6bVRTqTgSBpY4zT3K6e8.GNloQ6Qm/4aNXA8EaJHgLhoMRFrigvm',
                'created_at' => '2026-06-10 01:04:57', 'updated_at' => '2026-06-10 01:04:57'
            ],
            [
                'id' => 4, 'name' => 'viky', 'email' => 'viky@urbanvibe.com',
                'role' => 'customer', 'password' => '$2y$12$31g5XJiZeqzcy9wYIzUn1ejm9WYj9gl7Gw42Tnlw0CsFHf9.Aj27S',
                'created_at' => '2026-06-11 01:02:09', 'updated_at' => '2026-06-11 01:02:09'
            ],
            [
                'id' => 5, 'name' => 'viky', 'email' => 'vikyurbanvibe@gmail.com',
                'role' => 'customer', 'password' => '$2y$12$3M3XjehTKro6UrIqvV77qOF9Jwi2UhJnj4fC/5m3LxguYLNYwps0K',
                'created_at' => '2026-07-02 06:03:12', 'updated_at' => '2026-07-02 06:03:12'
            ]
        ]); //
    }
}
