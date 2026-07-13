<?php

namespace Tests\Feature;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductDetailOverlayTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_detail_modal_view_returns_stock_information(): void
    {
        $category = Category::create([
            'name' => 'Pakaian',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Oversize Hoodie',
            'price' => 250000,
            'stock' => 12,
            'image' => 'demo.png',
            'description' => 'Ukuran oversize premium',
        ]);

        $this->get(route('product.detail', $product->id) . '?modal=1')
            ->assertOk()
            ->assertViewIs('auth.product_detail_modal')
            ->assertSee('12 Pcs');
    }

    public function test_add_to_cart_returns_json_error_when_requested_quantity_exceeds_stock(): void
    {
        $customer = User::factory()->create([
            'role' => 'customer',
        ]);

        $category = Category::create([
            'name' => 'Sepatu',
        ]);

        $product = Product::create([
            'category_id' => $category->id,
            'name' => 'Sneakers',
            'price' => 350000,
            'stock' => 1,
            'image' => 'demo.png',
            'description' => 'Sneakers premium',
        ]);

        Cart::create(['user_id' => $customer->id]);

        $this->actingAs($customer)
            ->postJson(route('cart.add', $product->id), [
                'quantity' => 2,
                'size' => 'M',
            ], [
                'X-Requested-With' => 'XMLHttpRequest',
            ])
            ->assertStatus(422)
            ->assertJsonPath('success', false);
    }
}
