<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('order_details')->insert([
            ['id' => 1, 'order_id' => 3, 'product_id' => 6, 'quantity' => 1, 'price' => 295000, 'created_at' => '2026-06-11 03:11:32', 'updated_at' => '2026-06-11 03:11:32'],
            ['id' => 2, 'order_id' => 3, 'product_id' => 2, 'quantity' => 1, 'price' => 999000, 'created_at' => '2026-06-11 03:11:32', 'updated_at' => '2026-06-11 03:11:32'],
            ['id' => 3, 'order_id' => 3, 'product_id' => 9, 'quantity' => 1, 'price' => 189000, 'created_at' => '2026-06-11 03:11:32', 'updated_at' => '2026-06-11 03:11:32'],
            ['id' => 4, 'order_id' => 3, 'product_id' => 17, 'quantity' => 1, 'price' => 55000, 'created_at' => '2026-06-11 03:11:32', 'updated_at' => '2026-06-11 03:11:32'],
            ['id' => 5, 'order_id' => 3, 'product_id' => 38, 'quantity' => 1, 'price' => 395000, 'created_at' => '2026-06-11 03:11:32', 'updated_at' => '2026-06-11 03:11:32'],
            ['id' => 18, 'order_id' => 10, 'product_id' => 21, 'quantity' => 1, 'price' => 449000, 'created_at' => '2026-06-11 03:32:31', 'updated_at' => '2026-06-11 03:32:31'],
            ['id' => 19, 'order_id' => 10, 'product_id' => 17, 'quantity' => 1, 'price' => 55000, 'created_at' => '2026-06-11 03:32:31', 'updated_at' => '2026-06-11 03:32:31'],
            ['id' => 20, 'order_id' => 11, 'product_id' => 10, 'quantity' => 1, 'price' => 199000, 'created_at' => '2026-06-13 21:33:04', 'updated_at' => '2026-06-13 21:33:04'],
            ['id' => 21, 'order_id' => 11, 'product_id' => 17, 'quantity' => 1, 'price' => 55000, 'created_at' => '2026-06-13 21:33:04', 'updated_at' => '2026-06-13 21:33:04'],
            ['id' => 22, 'order_id' => 12, 'product_id' => 9, 'quantity' => 1, 'price' => 189000, 'created_at' => '2026-06-15 23:32:11', 'updated_at' => '2026-06-15 23:32:11'],
            ['id' => 23, 'order_id' => 12, 'product_id' => 13, 'quantity' => 1, 'price' => 379000, 'created_at' => '2026-06-15 23:32:11', 'updated_at' => '2026-06-15 23:32:11'],
            ['id' => 24, 'order_id' => 13, 'product_id' => 12, 'quantity' => 1, 'price' => 175000, 'created_at' => '2026-07-02 06:04:26', 'updated_at' => '2026-07-02 06:04:26'],
            ['id' => 25, 'order_id' => 13, 'product_id' => 13, 'quantity' => 1, 'price' => 379000, 'created_at' => '2026-07-02 06:04:26', 'updated_at' => '2026-07-02 06:04:26'],
        ]);
    }
}
