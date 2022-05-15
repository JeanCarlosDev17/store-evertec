<?php

namespace App\Http\Controllers;

use App\Actions\Admin\ImportProductsAction;
use App\Actions\Admin\StoreProductImagesAction;
use App\Actions\Admin\UpdateProductImagesAction;
use App\Exports\ProductsExport;
use App\Http\Requests\ExportDateRequest;
use App\Http\Requests\ImportedExcelRequest;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Jobs\NotifyCompleteExportToUser;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::select('id', 'name', 'description', 'maker', 'quantity', 'state')->get();
        return view('admin.products')->with('products', $products);
    }

    public function create(): View
    {
        return view('admin.addProduct');
    }

    public function store(ProductStoreRequest $request, StoreProductImagesAction $productImagesAction)
    {
        $product = new Product();
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->maker = $request->input('maker');
        $product->quantity = $request->input('quantity');
        $product->save();
        $productImagesAction->execute($request->images, $product);
        $result = 'Producto guardado exitosamente!';
        return response()->json(['success'=>$result]);
    }

    public function show(Product $product)
    {
        //
        return view('productShowDetails')->with('product', $product);
    }

    public function edit(Product $product): View
    {
        return view('admin.editProduct')->with('product', $product);
    }

    public function update(ProductUpdateRequest $request, Product $product, UpdateProductImagesAction $updateProductImagesAction)
    {
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->maker = $request->input('maker');
        $product->quantity = $request->input('quantity');
        $product->save();
        $updateProductImagesAction->execute($request->images, $product);
        $result = 'Producto Actualizado exitosamente!';
        return response()->json(['success'=>$result]);
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('result', 'Producto Eliminado');
    }

    public function State(Request $request, int $id)
    {
        $product = Product::find($id);

        $product->state = $product->state == 'active' ? 'inactive' : 'active';

        $product->save();
        return redirect(route('products.index'));
    }

    public function allToStore()
    {
        $products = Product::select('id', 'price', 'name', 'description', 'maker', 'quantity', 'state', 'discount')
            ->active()->Stock()->paginate(6);
        return view('welcome')->with('products', $products);
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'search'=>'required|max:160',
        ]);
        if ($validator->fails()) {
            $result = '';
            return view('welcome')->with('products', []);
        }
        $search = $request['search'];
        $products = Product::select('id', 'price', 'name', 'description', 'maker', 'quantity', 'state', 'discount')
            ->where([['state', '!=', 'inactive'], ['name', 'LIKE', '%' . $search . '%']])
            ->paginate(6);

        if (count($products) < 1) {
            $result = 'Sin resultados';
        } else {
            $result = '';
        }
        return view('welcome')->with(['products'=>$products, 'result'=>$result]);
    }

    public function export(ExportDateRequest $request)
    {
        $filepath = 'Products_' . Str::uuid()->toString() . '.xlsx';

        (new ProductsExport($request->get('start'), $request->get('end')))
            ->store($filepath, 'public')
            ->chain(
                [
                    new NotifyCompleteExportToUser(auth()->user(), asset('storage/' . $filepath)),
                ]
            );

        return redirect()->back()->with('result', 'Exporte en proceso, te enviaremos un email cuando finalice ');
    }

    public function import(ImportedExcelRequest $request, ImportProductsAction $importProductsAction)
    {
        $importProductsAction->execute($request->file('file'));
        return redirect()->back()->with('result', 'importe en proceso, te enviaremos un email cuando finalice ');
    }
}
