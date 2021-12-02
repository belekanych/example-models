<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Inertia\Inertia;

class EditController extends Controller
{
    public function __invoke(Order $order)
    {
        return Inertia::render('Order/Edit', [
            'orderId' => $order->id,
        ]);
    }
}
