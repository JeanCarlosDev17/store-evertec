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

//    Extrae a partir de la cookie el carrito si la cookie no existe el carrito tampoco entonces se crea uno
    public function execute(): Cart
    {
        $cart = $this->getCartFromCookie->execute();
        return $cart ?? Cart::create();
    }
}
