<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cart')->insert([
            ['id' => 1, 'user_id' => 3, 'created_at' => '2026-06-10 01:15:00', 'updated_at' => '2026-06-10 01:15:00'],
            ['id' => 7, 'user_id' => 5, 'created_at' => '2026-07-02 06:08:53', 'updated_at' => '2026-07-02 06:08:53'],
        ]);
    }
}
