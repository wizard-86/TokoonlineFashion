<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersSeeder::class,
            CategoriesSeeder::class,
            ProductsSeeder::class,
            CartSeeder::class,
            CartDetailSeeder::class,
            OrdersSeeder::class,
            OrderDetailsSeeder::class,
            PaymentSeeder::class,
            ShippingSeeder::class,
        ]);
    }
}
