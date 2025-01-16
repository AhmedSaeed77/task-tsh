<?php

namespace App\Repository;
use App\Models\Author;
use Illuminate\Support\Facades\DB;

class AuthorRepository implements AuthorRepositoryInterface
{

    public function __construct(private readonly Author $model)
    {

    }

    public function index()
    {
        return $this->model::query()->paginate(request('perPage'));
    }

    public function store($request)
    {
        try
        {
            $this->model->create($request);
            return response()->json(['message' => 'author is saved'], 200);
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
            return response()->json(['message' => 'author is updated'], 200);
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
            return response()->json(['message' => 'author is deleted'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

}
