<?php

namespace App\Http\Services;

use App\Repository\CategoryRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Http;
use App\Http\Resources\CategoryCollection;

class CategoryService
{
    public function __construct(
        private readonly CategoryRepositoryInterface  $categoryRepository,
    )
    {
    }

    public function index()
    {
        return new CategoryCollection($this->categoryRepository->paginate());
    }

    public function store($request)
    {
        try
        {
            $data = $request->validated();
            $this->categoryRepository->create($data);
            return response()->json(['message' => 'category is saved'], 201);
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
            $this->categoryRepository->delete($id);
            return response()->json(['message' => 'category is deleted'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }

    }
}
