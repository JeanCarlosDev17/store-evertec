<?php

namespace App\Actions\User;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class getCartFromCookieOrCreateAction
{
    protected getCartFromCookie $getCartFromCookie;
    public function __construct(getCartFromCookie $getCartFromCookie)
    {
        $this->getCartFromCookie=$getCartFromCookie;
    }

    public function execute(): Cart
    {
        $cart=$this->getCartFromCookie->execute();
//        dump($cart);
        return $cart ?? Cart::create();
    }
}
