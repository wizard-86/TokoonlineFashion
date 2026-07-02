<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartDetailSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cart_detail')->insert([
            ['id' => 7, 'cart_id' => 1, 'product_id' => 5, 'quantity' => 1, 'created_at' => '2026-06-10 02:38:02', 'updated_at' => '2026-06-10 02:38:25'],
            ['id' => 9, 'cart_id' => 1, 'product_id' => 17, 'quantity' => 1, 'created_at' => '2026-06-10 02:42:57', 'updated_at' => '2026-06-10 02:42:57'],
            ['id' => 10, 'cart_id' => 1, 'product_id' => 28, 'quantity' => 1, 'created_at' => '2026-06-10 02:43:08', 'updated_at' => '2026-06-10 02:43:08'],
            ['id' => 26, 'cart_id' => 7, 'product_id' => 11, 'quantity' => 1, 'created_at' => '2026-07-02 06:08:53', 'updated_at' => '2026-07-02 06:08:53'],
        ]);
    }
}
