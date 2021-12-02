<?php

namespace App\Http\Controllers\Api\Order\Status;

use App\Http\Controllers\Api\Controller;
use App\Http\Resources\OrderStatusResource;
use App\Models\OrderStatus;

class IndexController extends Controller
{
    public function __invoke()
    {
        return OrderStatusResource::collection(
            OrderStatus::all()
        );
    }
}
