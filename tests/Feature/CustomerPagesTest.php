<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerPagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_view_all_stores()
    {
        $store = Store::factory()->create();

        $this->get(route('home'))
            ->assertStatus(200)
            ->assertSee($store->name);
    }

    /** @test */
    public function a_user_can_view_a_single_store_and_its_products()
    {
        $store = Store::factory()->create();
        $product = Product::factory()->create(['store_id' => $store->id]);

        $this->get(route('customer.store', $store))
            ->assertStatus(200)
            ->assertSee($store->name)
            ->assertSee($product->name);
    }

    /** @test */
    public function a_user_can_add_a_product_to_the_cart()
    {
        $product = Product::factory()->create();

        $this->post(route('cart.add', $product))
            ->assertRedirect();

        $this->assertEquals(1, count(session('cart')));
    }

    /** @test */
    public function a_user_can_view_the_cart()
    {
        $product = Product::factory()->create();
        $this->post(route('cart.add', $product));

        $this->get(route('cart.index'))
            ->assertStatus(200)
            ->assertSee($product->name);
    }

    /** @test */
    public function a_user_can_update_the_cart()
    {
        $product = Product::factory()->create();
        $this->post(route('cart.add', $product));

        $this->patch(route('cart.update', $product), ['quantity' => 2]);

        $this->assertEquals(2, session('cart')[$product->id]['quantity']);
    }

    /** @test */
    public function a_user_can_remove_a_product_from_the_cart()
    {
        $product = Product::factory()->create();
        $this->post(route('cart.add', $product));

        $this->delete(route('cart.remove', $product));

        $this->assertEquals(0, count(session('cart')));
    }
}
