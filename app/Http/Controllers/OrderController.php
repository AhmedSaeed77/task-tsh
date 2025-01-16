<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Services\OrderService;

class OrderController extends Controller
{
    public function __construct(private readonly OrderService $order)
    {
    }

    public function getAllOrdersForUser()
    {
        return $this->order->getAllOrdersForUser();
    }

    public function store(OrderRequest $request)
    {
        return $this->order->store($request);
    }

}
