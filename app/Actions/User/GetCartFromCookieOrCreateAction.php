<?php

namespace App\Actions\User;

use App\Models\Cart;

class GetCartFromCookieOrCreateAction
{
    protected getCartFromCookie $getCartFromCookie;
    public function __construct(getCartFromCookie $getCartFromCookie)
    {
        $this->getCartFromCookie = $getCartFromCookie;
    }

    public function execute(): Cart
    {
        $cart = $this->getCartFromCookie->execute();
        return $cart ?? Cart::create();
    }
}
