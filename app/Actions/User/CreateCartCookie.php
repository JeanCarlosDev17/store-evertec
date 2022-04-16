<?php

namespace App\Actions\User;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Cookie as CookieSymfony;

class CreateCartCookie
{
    public function execute(Cart $cart): CookieSymfony
    {
        return Cookie::make('cart', $cart->id, 7*24*60);
    }
}
