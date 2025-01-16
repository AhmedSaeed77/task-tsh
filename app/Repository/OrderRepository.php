<?php

namespace App\Repository;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{

    public function __construct(private readonly Order $model)
    {

    }

    public function store($request)
    {
        return $this->model->create($request);
    }

    public function update($id,$request)
    {
        $order = $this->model::find($id);
        $order->update($request);
    }

    public function getAllOrdersForUser($id)
    {
        return $this->model::query()->where('user_id', $id)->get();
    }

}
