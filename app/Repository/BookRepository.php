<?php

namespace App\Repository;
use App\Models\Book;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BookRepository extends Repository implements BookRepositoryInterface
{

    protected Model $model;

    public function __construct(Book $model)
    {
        parent::__construct($model);
    }

    public function getAllBooks()
    {
        return $this->model::query()
                ->when(request()->has('title') && request('title') != null, function ($query) {
                    $query->where('title', 'like', '%' . request('title') . '%');
                })
                ->when(request()->has('category_id') && request('category_id') != null, function ($query) {
                    $query->where('category_id', request('category_id'));
                })
                ->when(request()->has('author_id') && request('author_id') != null, function ($query) {
                    $query->where('author_id', request('author_id'));
                })
                ->when(request()->has('author_name') && request('author_name') != null, function ($query) {
                    $query->whereHas('author', function ($query) {
                        $query->where('name', 'like', '%' . request('author_name') . '%');
                    });
                })
                ->paginate(request('perPage'));
    }

}
