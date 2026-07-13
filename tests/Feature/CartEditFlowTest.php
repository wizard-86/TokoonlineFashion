<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CartEditFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_cart_item_can_update_quantity_and_size(): void
    {
        $customer = User::factory()->create([
            'role' => 'customer',
        ]);

        $category = Category::create(['name' => 'Pakaian']);
        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Hoodie',
            'price' => 250000,
            'stock' => 10,
            'image' => 'demo.png',
            'description' => 'Hoodie premium',
        ]);

        $cart = Cart::create(['user_id' => $customer->id]);
        $detail = CartDetail::create([
            'cart_id' => $cart->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'size' => 'L',
        ]);

        $this->actingAs($customer)
            ->put(route('cart.update', $detail->id), [
                'quantity' => 3,
                'size' => 'XL',
            ])
            ->assertRedirect();

        $this->assertDatabaseHas('cart_detail', [
            'id' => $detail->id,
            'quantity' => 3,
            'size' => 'XL',
        ]);
    }
}
