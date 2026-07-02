<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'shoes', 'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'],
            ['id' => 2, 'name' => 'perfume', 'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'],
            ['id' => 3, 'name' => 't-shirt', 'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'],
            ['id' => 4, 'name' => 'hoodie', 'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'],
            ['id' => 5, 'name' => 'sock', 'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'],
            ['id' => 6, 'name' => 'jacket', 'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'],
            ['id' => 7, 'name' => 'hat', 'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'],
            ['id' => 8, 'name' => 'bag', 'created_at' => '2026-06-11 09:44:38', 'updated_at' => '2026-06-11 09:44:38'],
            ['id' => 9, 'name' => 'belt', 'created_at' => '2026-06-11 09:51:28', 'updated_at' => '2026-06-11 09:51:28'],
            ['id' => 10, 'name' => 'dress', 'created_at' => '2026-06-11 09:56:30', 'updated_at' => '2026-06-11 09:56:30'],
            ['id' => 11, 'name' => 'shirt', 'created_at' => '2026-06-11 09:59:38', 'updated_at' => '2026-06-11 09:59:38'],
        ]); //
    }
}
