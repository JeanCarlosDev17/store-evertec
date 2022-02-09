<?php

namespace Tests\Feature\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class ProductUpdateTest extends TestCase
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

    public function test_Update_product()
    {

        $dataInsert = [

            'name'=>'Product Test Inicial',
            'description'=>'a description test',
            'price'=>'123',
            'maker'=>'maker test',
            'quantity'=>'120',
        ];
        $user=User::where('email','jeancarlosrecio@hotmail.com')->get();
        $response = $this->actingAs($user[0])->post('/admin/products',$dataInsert);
        $product=Product::where('name','Product Test Inicial')->get();
        $this->assertDatabaseHas('products',$dataInsert);
        $dataUpdate = [

            'name'=>'Product Test Inicial ACTUALIZADO',
            'description'=>'a description test ACTUALIZADO',
            'price'=>'1237',
            'maker'=>'FABRICANTE TEST ACTUALIZADO',
            'quantity'=>'1207',
        ];
        
        $response = $this->actingAs($user[0])->put('admin/products/'.$product[0]->id,$dataUpdate);
        $this->assertDatabaseHas('products',$dataUpdate);
        $response->assertSessionHas('result', 'Producto Actualizado exitosamente!');
    }


    /**
     * @param array $data
     * @param string $field
     * @dataProvider invalidDataProvider
     */
    public function test_validations_store_product(array $dataUpdate,string $field):void
    {
        $dataInsert = [

            'name'=>'Product Test Inicial',
            'description'=>'a description test',
            'price'=>'123',
            'maker'=>'maker test',
            'quantity'=>'120',
        ];
        $user=User::where('email','jeancarlosrecio@hotmail.com')->get();
        $response = $this->actingAs($user[0])->post('/admin/products',$dataInsert);
        $product=Product::where('name','Product Test Inicial')->get();
        $this->assertDatabaseHas('products',$dataInsert);
        
        $response = $this->actingAs($user[0])->put('admin/products/'.$product[0]->id,$dataUpdate);
        $response->assertSessionHasErrors($field);
    }

    public function invalidDataProvider(){
//         'name'=>'required|min:3|max:150',
        return [
            'validate name required'=>[
                'data'=>array_replace($this->productData(),['name'=>null]),
                'field'=>'name'
            ],
            'validate name min3'=>[
                'data'=>array_replace($this->productData(),['name'=>'jj']),
                'field'=>'name'
            ],
            'validate name max 150'=>[
                'data'=>array_replace($this->productData(),['name'=>Str::random(151)]),
                'field'=>'name'
            ],
//            'description'=>'required|min:5|max:255',
            'validate description required'=>[
                'data'=>array_replace($this->productData(),['description'=>null]),
                'field'=>'description'
            ],
            'validate description min 5'=>[
                'data'=>array_replace($this->productData(),['description'=>'jj']),
                'field'=>'description'
            ],
            'validate description max price'=>[
                'data'=>array_replace($this->productData(),['description'=>Str::random(256)]),
                'field'=>'description'
            ],
//            'price'=>'required|integer|min:1|max:750000000000000',
            'validate price required'=>[
                'data'=>array_replace($this->productData(),['price'=>null]),
                'field'=>'price'
            ],
            'validate price integer'=>[
                'data'=>array_replace($this->productData(),['price'=>'jj']),
                'field'=>'price'
            ],
            'validate price min 1'=>[
                'data'=>array_replace($this->productData(),['price'=>'0']),
                'field'=>'price'
            ],
            'validate price max 750000000000000'=>[
                'data'=>array_replace($this->productData(),['price'=>'750000000000001']),
                'field'=>'price'
            ],
//            'quantity'=>'required|integer|min:0|max:16770200',
            'validate quantity required'=>[
                'data'=>array_replace($this->productData(),['quantity'=>null]),
                'field'=>'quantity'
            ],
            'validate quantity integer'=>[
                'data'=>array_replace($this->productData(),['quantity'=>'jj']),
                'field'=>'quantity'
            ],
            'validate quantity min 0'=>[
                'data'=>array_replace($this->productData(),['quantity'=>'-1']),
                'field'=>'quantity'
            ],
            'validate quantity max 16770201'=>[
                'data'=>array_replace($this->productData(),['quantity'=>'16770201']),
                'field'=>'quantity'
            ],
        ];
    }

    public function productData():array{
        $data = [

            'name'=>'Product Test Inicial ACTUALIZADO',
            'description'=>'a description test ACTUALIZADO',
            'price'=>'1237',
            'maker'=>'FABRICANTE TEST ACTUALIZADO',
            'quantity'=>'1207',
        ];
        return $data;
    }
}