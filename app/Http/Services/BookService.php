<?php

namespace App\Http\Services;

use App\Repository\BookRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Http;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;

class BookService
{
    public function __construct(
        private readonly BookRepositoryInterface  $bookRepository,
    )
    {
    }

    public function index()
    {
        return new BookCollection($this->bookRepository->getAllBooks());
    }

    public function store($request)
    {
        try
        {
            $data = $request->validated();
            $this->bookRepository->create($data);
            return response()->json(['message' => 'book is saved'], 201);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        return new BookResource($this->bookRepository->find($id));
    }

    public function update($id,$request)
    {
        try
        {
            $data = $request->validated();
            $this->bookRepository->update($id,$data);
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
            $this->bookRepository->delete($id);
            return response()->json(['message' => 'book is deleted'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }
}
