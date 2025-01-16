<?php

namespace App\Repository;
use App\Models\Book;
use Illuminate\Support\Facades\DB;

class BookRepository implements BookRepositoryInterface
{

    public function __construct(private readonly Book $model)
    {

    }

    public function index()
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

    public function store($request)
    {
        try
        {
            $this->model->create($request);
            return response()->json(['message' => 'book is saved'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        return $this->model::find($id);
    }

    public function update($request,$id)
    {
        try
        {
            $author = $this->model::find($id);
            $author->update($request);
            return response()->json(['message' => 'book is updated'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function destroy($id)
    {
        try
        {
            $this->model->find($id)->delete();
            return response()->json(['message' => 'book is deleted'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function find($id)
    {
        return $this->model::find($id);
    }

}
