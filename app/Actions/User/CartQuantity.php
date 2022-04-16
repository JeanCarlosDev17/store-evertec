<?php

namespace App\Actions\User;

use App\Models\Cart;
use Illuminate\Support\Facades\Cookie;

class CartQuantity
{
    protected getCartFromCookie $getCartFromCookie;
    public function __construct(getCartFromCookie $getCartFromCookie)
    {
        $this->getCartFromCookie=$getCartFromCookie;
    }

    public function execute(): int
    {
        $cart=$this->getCartFromCookie->execute();

        if (isset($cart)) {
            return $cart->products->pluck('pivot.quantity')->sum();
        }

        return 0;
    }
}
