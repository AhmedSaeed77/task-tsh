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
        return new AuthorCollection($this->authorRepository->index());
    }

    public function store($request)
    {
        $data = $request->validated();
        return $this->authorRepository->store($data);
    }

    public function show($id)
    {
        return new AuthorResource($this->authorRepository->show($id));
    }

    public function update($request, $id)
    {
        $data = $request->validated();
        return $this->authorRepository->update($data,$id);
    }

    public function destroy($id)
    {
        return $this->authorRepository->destroy($id);
    }
}
