<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreProductTest extends TestCase
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
    public function test_example()
    {

        $data = [

                'name'=>'Product Test',
                'description'=>'a description test',
                'price'=>'123',
                'maker'=>'maker test',
                'quantity'=>'120',
        ];
        $user=User::where('email','jeancarlosrecio@hotmail.com')->get();

        $response = $this->actingAs($user[0])->post('/admin/products',$data);
        dump(Product::all());
        $response->assertRedirect();
        $this->assertDatabaseHas('products',$data);
//        $response->assertViewIs('admin.addProduct');

    }
}
