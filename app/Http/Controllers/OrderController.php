<?php

namespace App\Http\Controllers;

use App\Actions\User\getCartFromCookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class OrderController extends Controller
{
    //
    protected getCartFromCookie $getCartFromCookie;
    public function __construct(getCartFromCookie $getCartFromCookie){
        $this->getCartFromCookie=$getCartFromCookie;
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

        return DB::transaction(function () use($request){
            $user=$request->user();
            $order=$user->orders()->create([
                'status'=>'pending'
            ]);
            $cart=$this->getCartFromCookie->execute();
            //toma cada elemento de la collecion pasa por la funcion anomima como parametro $product
            //genera un array $element donde  definimos la key o llave para acceder y los valores que contiene
            //esa llave del array en este caso para poder usar attach necesitamos como llave los id de los
            //productos y el valor  de quantity en ese registro
            $error=false;
            $messages=[];
            $cartProductWithQuantity=$cart->products
                ->mapWithKeys(function ($product,$error,$messages){
                    $element[$product->id]=['quantity'=>$product->pivot->quantity];
                    $quantity=$product->pivot->quantity;
                    if ($product->quantity < $quantity)
                    {
                        throw ValidationException::withMessages([
                            'product'=>"Se ha alcanzado el stock maximo del producto  {$product->name} no puede agregar mas de {$product->quantity}",
                        ]);
                    }
                    return $element;
                });

            if ($error)
            {
                throw ValidationException::withMessages([
                    'product'=>"Se ha alcanzado el stock maximo del producto  {$product->name} no puede agregar mas de {$product->quantity}",
                ]);
            }


            $order->products()->attach($cartProductWithQuantity->toArray());
        if ($product->quantity < $quantity+1)
        {
            throw ValidationException::withMessages([
                'product'=>"Se ha alcanzado el stock maximo del producto  {$product->name} no puede agregar mas de {$product->quantity}",
            ]);
        }
            return $order;
        },5);
    }
}
