<?php

namespace App\Actions\User;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class GetCartFromCookie
{
    public function execute()
    {
        $cartId = Cookie::get('cart');
        return Cart::find($cartId);
    }
}
