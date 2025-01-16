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
        return new CategoryCollection($this->categoryRepository->index());
    }

    public function store($request)
    {
        $data = $request->validated();
        return $this->categoryRepository->store($data);
    }

    public function destroy($id)
    {
        return $this->categoryRepository->destroy($id);
    }
}
