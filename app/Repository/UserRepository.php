<?php

namespace App\Repository;
use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(private readonly User $model)
    {

    }

    public function store($request)
    {
        return $this->model->create($request);
    }
}
