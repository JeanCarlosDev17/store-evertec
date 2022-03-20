<?php

namespace App\Actions\User;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class getCartFromCookieOrCreateAction
{
    public function execute():Cart
    {
        $cartId=Cookie::get('cart');
        $cart=Cart::find($cartId);
        return $cart ?? Cart::create();
    }
}
