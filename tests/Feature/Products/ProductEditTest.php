<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductEditTest extends TestCase
{
    use RefreshDatabase;
    public function boot()
    {

        ParallelTesting::setUpTestDatabase(function ($database, $token) {
            $this->artisan('db:seed');
        });
    }

    public function test_can_access_to_Edit_products()
    {

        $user = User::where('email', 'jeancarlosrecio@hotmail.com')->first();
        $response = $this->actingAs($user)->get(route('products.edit', Product::first()));
        $response->assertStatus(200);
        $response->assertViewIs('admin.editProduct');
        $response->viewData('product');
    }



}
