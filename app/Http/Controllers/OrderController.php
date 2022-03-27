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

        return view('ordersIndex')->with('orders',$user->orders()->paginate(6));
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

        return DB::transaction(function () use($request){
            $user=$request->user();
            $order=$user->orders()->create([
                'state'=>'PENDING'
            ]);
            $cart=$this->getCartFromCookie->execute();
            //toma cada elemento de la collecion pasa por la funcion anomima como parametro $product
            //genera un array $element donde  definimos la key o llave para acceder y los valores que contiene
            //esa llave del array en este caso para poder usar attach necesitamos como llave los id de los
            //productos y el valor  de quantity en ese registro
            $error=false;
            $messages=[];
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


            $data=$this->createDataSession->getCreateSessionData($order);


            try {

                $session=$this->webcheckoutService->createSession($data);
//                dump('laaaaaaaaaaaaaaaaaaa sesion',$session);
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


            //conectarse a Checkout
//

            return  redirect()->route('orders.show',[$order->id]);

        },5);
    }
}
