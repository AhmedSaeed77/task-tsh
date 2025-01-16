<?php

namespace App\Repository;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CatgoryRepository implements CategoryRepositoryInterface
{

    public function __construct(private readonly Category $model)
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
            return response()->json(['message' => 'category is saved'], 200);
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
            return response()->json(['message' => 'category is deleted'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

}
