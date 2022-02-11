<?php

namespace App\Http\Controllers;

use App\Actions\Admin\StoreProductImagesAction;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ProductController extends Controller
{

    public function index()
    {
        //
//        $products=Product::select('id','name','description','maker','quantity','state')->paginate(6);
        $products=Product::select('id','name','description','maker','quantity','state')->get();


//        $products=[];
//        dd($products);
        return view('admin.products')->with('products',$products);
    }

    public function create():View
    {
        //
        return view('admin.addProduct');
    }

    public function store(Request $request,StoreProductImagesAction $productImagesAction):RedirectResponse
    {
//        dump($request->images);
//        foreach ($request->images as $image){
//            dump($image->getClientOriginalName());
//        }
        $product=new Product();
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->maker=$request->input('maker');
        $product->quantity=$request->input('quantity');
        $product->save();
        $productImagesAction->execute($request->images,$product);
        $result='Producto guardado exitosamente!';
        return redirect()->back()->with('result',$result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product):View
    {
        return view('admin.editProduct')->with('product',$product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest  $request, Product $product)
    {
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->maker=$request->input('maker');
        $product->quantity=$request->input('quantity');
        $product->save();
        $result='Producto Actualizado exitosamente!';
        return redirect()->back()->with('result',$result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route('products.index'))->with('result','Producto Eliminado');
    }

    /*public function state(Product $product){
        dump($product);
    }*/
    /*

    */
    public function State(Request $request, int $id)
    {
        $product=Product::find($id);


        $product->state = $product->state=='active' ? 'inactive' : 'active';;
        $product->save();
        return redirect(route('products.index'));
    }
    public function allToStore(){
        $products=Product::select('id','name','description','maker','quantity','state')->get();

        $products=Product::where('state','!=','inactive')->paginate(6);
//        dump($products);
        return view('welcome')->with('products',$products);
    }

}
