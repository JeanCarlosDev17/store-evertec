<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateCartCookie;
use App\Actions\User\GetCartFromCookieOrCreateAction;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ProductCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function store(
        Request $request,
        Product $product,
        GetCartFromCookieOrCreateAction $cartFromCookieOrCreateAction,
        CreateCartCookie $createCartCookie
    ) {
        $cart = $cartFromCookieOrCreateAction->execute();

        $quantity = $cart->products()->find($product->id)->pivot->quantity ?? 0;

        if ($product->quantity < $quantity + 1) {
            throw ValidationException::withMessages([
               'product'=>"Se ha alcanzado el stock maximo del producto  {$product->name} no puede agregar mas de {$product->quantity}",
            ]);
        }

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity'=>$quantity + 1],
        ]);

        $cookie = $createCartCookie->execute($cart);
        return redirect()->back()->cookie($cookie);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, Cart $cart, CreateCartCookie $createCartCookie): \Illuminate\Http\Response
    {
//        dump("el maximo es ".$product->quantity, 'y el valor recibido es '.$request->quantity);
        $validator = Validator::make($request->all(), [
            'quantity' => ['required', 'integer', 'max:' . $product->quantity, 'min:0'],
            'action'=>['required', Rule::in(['decrease', 'add'])],
        ], $messages = [
            'quantity.max'=>'Se ha alcanzado el stock maximo del producto ' . $product->name . ', no puede agregar mas de ' . $product->quantity,
            'action.in'=>'Acción invalida',

        ]);
//        dump($validator);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        if ($request->quantity < 1) {
            $cart->products()->detach($product->id);
            $cookie = $createCartCookie->execute($cart);
            return redirect()->back()->cookie($cookie);
        }

        $cart->products()->syncWithoutDetaching([
            $product->id => ['quantity'=>$request->quantity],
        ]);
        $cookie = $createCartCookie->execute($cart);
        return redirect()->back()->cookie($cookie);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, Cart $cart, CreateCartCookie $createCartCookie)
    {
        $cart->products()->detach($product->id);

        $cookie = $createCartCookie->execute($cart);
        return redirect()->back()->cookie($cookie);
        return $product;
    }
}
