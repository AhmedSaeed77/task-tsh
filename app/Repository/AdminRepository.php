<?php

namespace App\Repository;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminRepository extends Repository implements AdminRepositoryInterface
{
    protected Model $model;

    public function __construct(Admin $model)
    {
        parent::__construct($model);
    }
}
