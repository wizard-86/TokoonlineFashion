<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('shipping')->insert([
            ['id' => 1, 'order_id' => 10, 'address' => 'njawu', 'city' => null, 'postal_code' => null, 'courier' => 'JNE', 'shipping_cost' => 0, 'status' => 'pending', 'created_at' => '2026-06-11 03:32:31', 'updated_at' => '2026-06-11 03:32:31'],
            ['id' => 2, 'order_id' => 11, 'address' => 'njawu', 'city' => null, 'postal_code' => null, 'courier' => 'JNE', 'shipping_cost' => 0, 'status' => 'pending', 'created_at' => '2026-06-13 21:33:04', 'updated_at' => '2026-06-13 21:33:04'],
            ['id' => 3, 'order_id' => 12, 'address' => 'njawu', 'city' => null, 'postal_code' => null, 'courier' => 'JNE', 'shipping_cost' => 0, 'status' => 'pending', 'created_at' => '2026-06-15 23:32:11', 'updated_at' => '2026-06-15 23:32:11'],
            ['id' => 4, 'order_id' => 13, 'address' => 'njawu', 'city' => null, 'postal_code' => null, 'courier' => 'JNE', 'shipping_cost' => 0, 'status' => 'pending', 'created_at' => '2026-07-02 06:04:26', 'updated_at' => '2026-07-02 06:04:26'],
        ]);
    }
}
