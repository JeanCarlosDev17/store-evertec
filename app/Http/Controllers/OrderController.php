<?php

namespace App\Http\Controllers;

use App\Actions\User\getCartFromCookie;
use App\Models\Order;
use App\Request\CreateSessionDataRequest;
use App\Services\WebcheckoutService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Request\CreateSessionRequest;

class OrderController extends Controller
{
    //
    protected getCartFromCookie $getCartFromCookie;
    protected CreateSessionDataRequest $createDataSession;
    protected WebcheckoutService $webcheckoutService;
    public function __construct(getCartFromCookie $getCartFromCookie,
                                CreateSessionDataRequest $createSessionDataRequest,
                                WebcheckoutService $webcheckoutService
                                )
    {
        $this->getCartFromCookie = $getCartFromCookie;
        $this->createDataSession = $createSessionDataRequest;
        $this->webcheckoutService = $webcheckoutService;

    }

    public  function index(Request $request){

        $user=$request->user();

        return view('ordersIndex')->with('orders',$user->orders()->orderBy('id', 'DESC')->paginate(6));
    }

    public function create()
    {

    }

    public function show(Order $order)
    {
        return view('orderShow')->with('order',$order);
    }

    public function store(Request $request)
    {
//        dump($request->all());
        return DB::transaction(function () use($request){
            $user=$request->user();
            $order=$user->orders()->create([
                'state'=>'PENDING'
            ]);
            $cart=$this->getCartFromCookie->execute();

            $error=false;
            $messages=[];
            if ($cart->products->isEmpty()){
                throw ValidationException::withMessages([
                    'product'=>"Se ha enviado un carrito de compras vacio intente nuevamente añadir y realizar la compra",
                ]);
            }
            //toma cada elemento de la collecion pasa por la funcion anomima como parametro $product
            //genera un array $element donde  definimos la key o llave para acceder y los valores que contiene
            //esa llave del array en este caso para poder usar attach necesitamos como llave los id de los
            //productos y el valor  de quantity en ese registro

            $cartProductWithQuantity=$cart->products
                ->mapWithKeys(function ($product){
                    $quantity=$product->pivot->quantity;
                    if ($product->quantity < $quantity)
                    {
                        throw ValidationException::withMessages([
                            'product'=>"Se ha alcanzado el stock maximo del producto  {$product->name} , hay disponibles  {$product->quantity} unidades",
                        ]);
                    }
                    $product->decrement('quantity',$quantity);
                    $element[$product->id]=['quantity'=>$quantity];
                    return $element;
                });

            $order->products()->attach($cartProductWithQuantity->toArray());
            $order->total=$order->products->pluck('total')->sum();
            $order->currency='COP';
            $order->save();
            $cart->products()->detach();
            //conectarse a Checkout
            $data=$this->createDataSession->getCreateSessionData($order);
            try {
                $session=$this->webcheckoutService->createSession($data);

                $order->session_id= $session['requestId'];
                $order->process_url=$session['processUrl'];
                $order->save();
                return redirect($session['processUrl']);
            } catch (HttpException $ex) {
//                echo $ex;
                throw ValidationException::withMessages([
                    'product'=>$ex
                ]);
            }

//            return  redirect()->route('orders.show',[$order->id]);

        },5);
    }


    public function returnPay(Order $order)
    {
        if (isset($order))
        {
            $response=$this->webcheckoutService->getInformation($order->session_id);
            if (!($order->state == $response['status']['status'])){
                $order->state=$response['status']['status'];
                if ($response['status']['status']=="REJECTED")
                {
                    dump('Retornando a Buyme,  PAGO RECHAZADO');
                    foreach ($order->products as $product)
                    {
                        dump('product antes de retornar el stock',$product->quantity);

                        $product->increment('quantity',$product->pivot->quantity);
                        dump('product despues de retornar el stock',$product->quantity);
                    }
                }
                $order->save();
            }



            return redirect()->route('orders.show',$order->id);
        }
        else
        {
            return redirect()->route('orders.index');
        }
    }
}