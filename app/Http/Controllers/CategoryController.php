<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(private readonly CategoryService $category)
    {
    }

    public function index()
    {
        return $this->category->index();
    }

    public function store(CategoryRequest $request)
    {
        return $this->category->store($request);
    }

    public function destroy($id)
    {
        return $this->category->destroy($id);
    }

}
