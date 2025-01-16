<?php

namespace App\Repository;
use App\Models\OrderBook;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderBookRepository extends Repository implements OrderBookRepositoryInterface
{

    protected Model $model;

    public function __construct(OrderBook $model)
    {
        parent::__construct($model);
    }

}
