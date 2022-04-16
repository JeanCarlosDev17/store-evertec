<?php

namespace App\Request;

use App\Models\Order;

class CreateSessionDataRequest
{
    public function getCreateSessionData(Order $order): array
    {
        return [
            'payment' => [
                'reference' => $order->reference,
                'description' => $order->description ?? 'una descripcion ',
                'amount' => [
                    'currency' => $order->currency ,
                    'total' => substr($order->total, 0, 255)
                ]
            ],
            'returnUrl' => route('orders.return', [$order->id]),
            'expiration' => date('c', strtotime('+2 days')),
        ];
    }
}
