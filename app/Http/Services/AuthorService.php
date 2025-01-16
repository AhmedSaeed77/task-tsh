<?php

namespace App\Http\Services;

use App\Repository\AuthorRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Http\Helpers\Http;
use App\Http\Resources\AuthorCollection;
use App\Http\Resources\AuthorResource;

class AuthorService
{
    public function __construct(
        private readonly AuthorRepositoryInterface  $authorRepository,
    )
    {
    }

    public function index()
    {
        return new AuthorCollection($this->authorRepository->paginate());
    }

    public function store($request)
    {
        try
        {
            $data = $request->validated();
            $this->authorRepository->create($data);
            return response()->json(['message' => 'author is saved'], 201);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        return new AuthorResource($this->authorRepository->find($id));
    }

    public function update($id,$request)
    {
        try
        {
            $data = $request->validated();
            $this->authorRepository->update($id,$data);
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
            $this->authorRepository->delete($id);
            return response()->json(['message' => 'author is deleted'], 200);
        }
        catch (\Exception $e)
        {
            return response()->json($e->getMessage(), 400);
        }

    }
}
