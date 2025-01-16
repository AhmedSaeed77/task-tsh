<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use App\Http\Services\BookService;

class BookController extends Controller
{
    public function __construct(private readonly BookService $book)
    {
    }

    public function index()
    {
        return $this->book->index();
    }

    public function store(BookRequest $request)
    {
        return $this->book->store($request);
    }

    public function show($id)
    {
        return $this->book->show($id);
    }

    public function update($id,BookRequest $request)
    {
        return $this->book->update($id,$request);
    }

    public function destroy($id)
    {
        return $this->book->destroy($id);
    }

}
