<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Services\WebcheckoutService;
use Illuminate\Console\Command;

class CheckOrdersPayment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckOrdersPayment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find all orders with pending status, check and update their status if necessary';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected WebcheckoutService $webcheckoutService;

    public function __construct()
    {
        parent::__construct();

        $this->webcheckoutService = new WebcheckoutService();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
//        dump('ejecutado a las '.date("Y-m-d H:i:s"));
        $orders = Order::where('state', '=', 'PENDING')
            ->where('session_id', '!=', null)
            ->get();
//        dump($orders);
//        dump($orders->isEmpty());
        if (!($orders->isEmpty())) {
            foreach ($orders as $order) {
                if (isset($order->session_id)) {
                    $response = $this->webcheckoutService->getInformation($order->session_id);
//                    dump("Orden  ". $order->reference. " Estado actual ".$response['status']['status']);
                    if ($response['status']['status'] == 'APPROVED') {
                        $order->state = $response['status']['status'];
                        $order->save();
                        //notificar al usuario que su compra fue realizada
                        // dump("TUUUUUUU COMPRA HA SIDO CONFIRMADA YEEIIIIIII");
                    }

                    if ($response['status']['status'] == 'REJECTED') {
//                        dump('ehhhh PAGO RECHAZADO');
                        $order->state = $response['status']['status'];
                        $order->save();
                        foreach ($order->products as $product) {
//                            dump('product antes de retornar el stock',$product->quantity);
                            $product->increment('quantity', $product->pivot->quantity);
//                            dump('product despues de retornar el stock',$product->quantity);
                        }
                        // dump('pago rechazado procesado');
                    }

                    if ($response['status']['status'] == 'PENDING') {
                        // dump('ehhhh pero que tacaño todavia no me paga');
                    }
                }
            }
        } else {
            // dump('vacio ninguna orden pendiente');
//
        }

//        dump($orders);
        return 0;
    }
}
