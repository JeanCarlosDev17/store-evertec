<?php

namespace App\Http\Controllers;

use App\Actions\Admin\StoreProductImagesAction;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Actions\Admin\UpdateProductImagesAction;
use Illuminate\Support\Facades\Validator;


class ProductController extends Controller
{

    public function index()
    {

//        $products=Product::select('id','name','description','maker','quantity','state')->paginate(6);
        $products=Product::select('id','name','description','maker','quantity','state')->get();
        return view('admin.products')->with('products',$products);
    }

    public function create():View
    {
        //
        return view('admin.addProduct');
    }

    public function store(ProductStoreRequest   $request,StoreProductImagesAction $productImagesAction)
    {

//        dump($request);
//        dump($request->all());

        /*$validator = Validator::make($request->all(), [
            'name'=>'required|min:3|max:150',
            'description'=>'required|min:5|max:255',
            'price'=>'required|integer|min:1|max:750000000000000',
            'quantity'=>'required|integer|min:0|max:16770200',
            'maker'=>'max:100',
            'images' => ['required','array'],
            //'images'=> 'image|max:2000|dimensions:min_width=100, max_width=800,min_height=200,max_height=400,ratio=3/2 '
            'images.*' => [
                'image',
                'max:2500',
                Rule::dimensions()->maxWidth(600)->maxHeight(600)
//                    ->ratio(1)
                ,
                'mimes:jpg,jpeg,png,bmp'
            ]
        ]);

        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()->all()]);
//            return redirect()->withErrors($validator)->withInput();
//            return redirect()->back()
//                ->withErrors($validator)
//                ->withInput();
        }*/


        $product=new Product();
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->maker=$request->input('maker');
        $product->quantity=$request->input('quantity');
        $product->save();
        $productImagesAction->execute($request->images,$product);
        $result='Producto guardado exitosamente!';
        return response()->json(['success'=>$result]);
//        return redirect()->back()->with('result',$result);
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
        return view('productShowDetails')->with('product',$product);
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
    public function update(ProductUpdateRequest  $request, Product $product,UpdateProductImagesAction $updateProductImagesAction)
    {
//        dump($request->all());
//
        $product->name=$request->input('name');
        $product->description=$request->input('description');
        $product->price=$request->input('price');
        $product->maker=$request->input('maker');
        $product->quantity=$request->input('quantity');
        $product->save();
//        $result='Producto Actualizado exitosamente!';
//        return redirect()->back()->with('result',$result);
//
//
//        dump("imagenes",$request->images);
        $updateProductImagesAction->execute($request->images,$product);
        $result='Producto Actualizado exitosamente!';
        return response()->json(['success'=>$result]);
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
        return redirect()->back()->with('result','Producto Eliminado');
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
//        $products=Product::select('id','name','description','maker','quantity','state')->get();

        $products=Product::select('id','price','name','description','maker','quantity','state','discount')->where('state','!=','inactive')->paginate(6);
//        dump($products);
        return view('welcome')->with('products',$products);
    }


//    public function createimages(Request $request,Product $product){
//        $result='Producto creado exitosamente!';
//        return redirect()->back()->with('result',$result);
//    }

    public function search(Request $request){

        $validator = Validator::make($request->all(), [
            'search'=>'required|max:160'
        ]);
        if ($validator->fails()) {
            $result="";
            return view('welcome')->with('products',[]);
            return redirect()->withErrors($validator);
        }
        $search=$request['search'];
        $products=Product::select('id','price','name','description','maker','quantity','state','discount')
            ->where([['state','!=','inactive'],['name','LIKE','%'.$search.'%']])
            ->paginate(6);
//        dump($products);
        if (count($products)<1) {
            $result = "Sin resultados";
        }
        else{
            $result="";
        }
//        dump($products);
//        return redirect()->back()->with('products',$products);
//        return vii  ->with('products',$products);
        return view('welcome')->with(['products'=>$products,'result'=>$result]);
    }
}
