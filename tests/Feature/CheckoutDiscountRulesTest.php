<?php

namespace Tests\Feature;

use App\Models\Bundle;
use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckoutDiscountRulesTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_combines_bundle_discount_nominal_coupon_and_member_points(): void
    {
        $customer = User::factory()->create([
            'role' => 'customer',
            'coins' => 25,
        ]);

        $category = Category::create(['name' => 'Pakaian']);

        $productA = Product::create([
            'category_id' => $category->id,
            'name' => 'Produk A',
            'price' => 120000,
            'image' => 'a.jpg',
            'description' => 'Produk A',
        ]);

        $productB = Product::create([
            'category_id' => $category->id,
            'name' => 'Produk B',
            'price' => 120000,
            'image' => 'b.jpg',
            'description' => 'Produk B',
        ]);

        $bundle = Bundle::create([
            'name' => 'Bundle Hemat',
            'bundle_price' => 180000,
        ]);
        $bundle->products()->attach([$productA->id, $productB->id]);

        $cart = Cart::create(['user_id' => $customer->id]);
        CartDetail::create(['cart_id' => $cart->id, 'product_id' => $productA->id, 'quantity' => 1]);
        CartDetail::create(['cart_id' => $cart->id, 'product_id' => $productB->id, 'quantity' => 1]);

        Coupon::create([
            'code' => 'POTONG20',
            'type' => 'nominal',
            'value' => 20000,
            'min_order' => 150000,
            'quota' => 10,
            'status' => 'active',
            'expires_at' => now()->addDays(7),
            'created_by' => $customer->id,
        ]);

        $this->actingAs($customer)
            ->get(route('checkout.index', [
                'coupon_code' => 'POTONG20',
                'use_coins_applied' => '1',
            ]))
            ->assertOk()
            ->assertViewHas('subtotal', 240000)
            ->assertViewHas('bundleDiscount', 60000)
            ->assertViewHas('voucherDiscount', 20000)
            ->assertViewHas('coinsUsed', 25)
            ->assertViewHas('coinsUsedValue', 25000)
            ->assertViewHas('coinsEarned', 14)
            ->assertViewHas('totalFinalRupiah', 123000);
    }
}
