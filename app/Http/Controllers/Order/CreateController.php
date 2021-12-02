<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class CreateController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Order/Create');
    }
}
