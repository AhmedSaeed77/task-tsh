<?php

namespace App\Repository;
use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderRepository extends Repository implements OrderRepositoryInterface
{
    protected Model $model;

    public function __construct(Order $model)
    {
        parent::__construct($model);
    }

    public function getAllOrdersForUser($id)
    {
        return $this->model::query()->where('user_id', $id)->get();
    }

}
