<?php

namespace App\Repository;

interface OrderRepositoryInterface
{
    public function store($request);
    public function update($id,$request);
    public function getAllOrdersForUser($id);
}
