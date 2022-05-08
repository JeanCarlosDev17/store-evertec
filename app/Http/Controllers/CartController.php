<?php

namespace App\Http\Controllers;

use App\Actions\User\GetCartFromCookie;

class CartController extends Controller
{
    public function index(GetCartFromCookie $cartFromCookie)
    {
        $cart = $cartFromCookie->execute();

        return view('cart')->with(['cart'=>$cart]);
    }
}
