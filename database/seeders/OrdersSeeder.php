<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('orders')->insert([
            ['id' => 3, 'user_id' => 4, 'total_price' => 1933000, 'status' => 'pending', 'created_at' => '2026-06-11 03:11:32', 'updated_at' => '2026-06-11 03:11:32'],
            ['id' => 10, 'user_id' => 4, 'total_price' => 504000, 'status' => 'pending', 'created_at' => '2026-06-11 03:32:31', 'updated_at' => '2026-06-11 03:32:31'],
            ['id' => 11, 'user_id' => 4, 'total_price' => 254000, 'status' => 'pending', 'created_at' => '2026-06-13 21:33:04', 'updated_at' => '2026-06-13 21:33:04'],
            ['id' => 12, 'user_id' => 4, 'total_price' => 568000, 'status' => 'pending', 'created_at' => '2026-06-15 23:32:11', 'updated_at' => '2026-06-15 23:32:11'],
            ['id' => 13, 'user_id' => 5, 'total_price' => 554000, 'status' => 'pending', 'created_at' => '2026-07-02 06:04:26', 'updated_at' => '2026-07-02 06:04:26'],
        ]);
    }
}
