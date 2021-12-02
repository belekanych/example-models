<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class ShowController extends Controller
{
    public function __invoke(Order $order)
    {
        $order->loadMissing([
            'client',
            'status',
        ]);

        return OrderResource::make($order);
    }
}
