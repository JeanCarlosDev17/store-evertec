<?php

namespace App\Console\Commands;

use App\Constants\RequestState;
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
        $orders = Order::where('state', '=', RequestState::PENDING)
            ->where('session_id', '!=', null)
            ->get();

        if (!($orders->isEmpty())) {
            foreach ($orders as $order) {
                if (isset($order->session_id)) {
                    $response = $this->webcheckoutService->getInformation($order->session_id);
                    if ($response['status']['status'] == RequestState::APPROVED) {
                        $order->state = $response['status']['status'];
                        $order->save();
                        //TODO:notificar al usuario que su compra fue realizada
                    }
                    if ($response['status']['status'] == RequestState::REJECTED) {
                        $order->state = $response['status']['status'];
                        $order->save();
                        foreach ($order->products as $product) {
                            $product->increment('quantity', $product->pivot->quantity);
                        }
                    }
                }
            }
        }

        return 0;
    }
}
