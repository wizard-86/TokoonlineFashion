<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\Bundle;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DiscountSystemSeeder extends Seeder
{
    public function run()
    {
        // 1. Tambah Contoh Kupon Diskon Persen & Nominal
        Coupon::updateOrCreate(['code' => 'URBAN10'], [
            'type' => 'percentage',
            'value' => 10, // Diskon 10%
            'min_order' => 0,
            'quota' => 50
        ]);

        Coupon::updateOrCreate(['code' => 'POTONG20'], [
            'type' => 'nominal',
            'value' => 20000, // Potongan Rp 20.000
            'min_order' => 150000, // Minimal belanja Rp 150.000
            'quota' => 30
        ]);

        // 2. Berikan Koin Awal ke User untuk Testing Potongan di Checkout
        $user = User::first();
        if ($user) {
            $user->update(['coins' => 25]); // Beri 25 Koin (Setara Rp 25.000 potongan)
        }

        // 3. Tambah Contoh Diskon Paket Bundle
        // Mengambil 2 produk pertama yang ada di database kamu untuk dibundle
        $products = Product::take(2)->get();
        if ($products->count() >= 2) {
            $bundle = Bundle::create([
                'name' => 'Paket Hemat Urban Vibe (Produk 1 + 2)',
                'bundle_price' => 80000 // Harga paket core core murah
            ]);

            // Sinkronkan produk ke dalam bundle pivot
            $bundle->products()->attach($products->pluck('id'));
        }
    }
}
