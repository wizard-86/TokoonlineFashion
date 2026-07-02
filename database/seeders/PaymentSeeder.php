<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payment')->insert([
            ['id' => 1, 'order_id' => 3, 'payment_method' => 'Bank Transfer', 'amount' => 1933000, 'status' => 'pending', 'payment_date' => null, 'created_at' => '2026-06-11 03:11:32', 'updated_at' => '2026-06-11 03:11:32'],
            ['id' => 2, 'order_id' => 10, 'payment_method' => 'Bank Transfer', 'amount' => 504000, 'status' => 'pending', 'payment_date' => null, 'created_at' => '2026-06-11 03:32:31', 'updated_at' => '2026-06-11 03:32:31'],
            ['id' => 3, 'order_id' => 11, 'payment_method' => 'Bank Transfer', 'amount' => 254000, 'status' => 'pending', 'payment_date' => null, 'created_at' => '2026-06-13 21:33:04', 'updated_at' => '2026-06-13 21:33:04'],
            ['id' => 4, 'order_id' => 12, 'payment_method' => 'Bank Transfer', 'amount' => 568000, 'status' => 'pending', 'payment_date' => null, 'created_at' => '2026-06-15 23:32:11', 'updated_at' => '2026-06-15 23:32:11'],
            ['id' => 5, 'order_id' => 13, 'payment_method' => 'Bank Transfer', 'amount' => 554000, 'status' => 'pending', 'payment_date' => null, 'created_at' => '2026-07-02 06:04:26', 'updated_at' => '2026-07-02 06:04:26'],
        ]);
    }
}
