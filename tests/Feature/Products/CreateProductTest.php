<?php

namespace Tests\Feature\Products;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;
    public function boot()
    {
        // Executed when a test database is created...
        ParallelTesting::setUpTestDatabase(function ($database, $token) {
            $this->artisan('db:seed');
        });
    }

    public function test_can_access_to_creation_products()
    {
        $user = User::where('email', 'jeancarlosrecio@hotmail.com')->get();
        $response = $this->actingAs($user[0])->get('/admin/products/create');
        $response->assertStatus(200);
    }

    public function test_can_access_to_view_creation_products()
    {
        $user = User::where('email', 'jeancarlosrecio@hotmail.com')->get();
        $response = $this->actingAs($user[0])->get('/admin/products/create');
        $response->assertViewIs('admin.addProduct');
    }
}
