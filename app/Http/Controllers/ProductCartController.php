<?php

namespace App\Http\Controllers;

use App\Actions\User\CreateCartCookie;
use App\Actions\User\GetCartFromCookieOrCreateAction;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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
    public function store(Request $request,
                          Product $product,
                          GetCartFromCookieOrCreateAction  $cartFromCookieOrCreateAction,
                          CreateCartCookie $createCartCookie

    )
    {

        $cart= $cartFromCookieOrCreateAction->execute();

        $quantity=$cart->products()->find($product->id)->pivot->quantity ?? 0;
        $cart->products()->syncWithoutDetaching([
                $product->id => ['quantity'=>$quantity + 1 ]
            ]);


        $cookie=$createCartCookie->execute($cart);
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
    public function update(Request $request, Product $product, Cart $cart)
    {
        //
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

        $cookie=$createCartCookie->execute($cart);
        return redirect()->back()->cookie($cookie);
    }


}

