<?php

namespace App\Repository;
use App\Models\OrderBook;
use Illuminate\Support\Facades\DB;

class OrderBookRepository implements OrderBookRepositoryInterface
{

    public function __construct(private readonly OrderBook $model)
    {

    }

    public function store($request)
    {
        return $this->model->create($request);
    }

}
