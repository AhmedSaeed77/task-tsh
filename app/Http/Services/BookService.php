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
        return new BookCollection($this->bookRepository->index());
    }

    public function store($request)
    {
        $data = $request->validated();
        return $this->bookRepository->store($data);
    }

    public function show($id)
    {
        return new BookResource($this->bookRepository->show($id));
    }

    public function update($request, $id)
    {
        $data = $request->validated();
        return $this->bookRepository->update($data,$id);
    }

    public function destroy($id)
    {
        return $this->bookRepository->destroy($id);
    }
}
