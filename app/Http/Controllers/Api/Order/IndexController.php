<?php

namespace App\Http\Controllers\Api\Order;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;

class IndexController extends Controller
{
    public function __invoke()
    {
        return OrderResource::collection(
            Order::with(['status', 'client'])->get()
        );
    }
}
