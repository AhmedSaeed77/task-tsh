<?php

namespace App\Repository;
use App\Models\Author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AuthorRepository extends Repository implements AuthorRepositoryInterface
{

    protected Model $model;

    public function __construct(Author $model)
    {
        parent::__construct($model);
    }

}
