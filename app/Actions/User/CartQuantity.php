<?php

namespace App\Actions\User;

class CartQuantity
{
    protected getCartFromCookie $getCartFromCookie;
    public function __construct(getCartFromCookie $getCartFromCookie)
    {
        $this->getCartFromCookie = $getCartFromCookie;
    }

    public function execute(): int
    {
        $cart = $this->getCartFromCookie->execute();

        if (isset($cart)) {
            return $cart->products->pluck('pivot.quantity')->sum();
        }

        return 0;
    }
}
