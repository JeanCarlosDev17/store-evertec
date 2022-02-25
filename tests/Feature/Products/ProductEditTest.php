<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
class ProductEditTest extends TestCase
{
    use RefreshDatabase;
    public function boot()
    {
        // Executed when a test database is created...
        ParallelTesting::setUpTestDatabase(function ($database, $token) {
            $this->artisan('db:seed');
        });
    }

    public function test_can_access_to_Edit_products()
    {
        //crear producto y un usuario con factory para cada test
        $user=User::where('email','jeancarlosrecio@hotmail.com')->first();
//        dump($user);
        $response = $this->actingAs($user)->get(route('products.edit',Product::first()));
        $response->assertStatus(200);
        $response->assertViewIs('admin.editProduct');
        $response->viewData('product');
    }
    /*
     * Por que al ejecutar el test individualmente pasa pero al ejecutar en conjunto falla
     *
     * */

    /*public function test_can_access_to_view_creation_products()
    {
        $user=User::where('email','jeancarlosrecio@hotmail.com')->get();
        dump($user);
        $response = $this->actingAs($user[0])->get(route('products.edit','3'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.editProduct');
    }*/
}
