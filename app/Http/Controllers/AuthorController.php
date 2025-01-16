<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AuthorRequest;
use App\Http\Services\AuthorService;

class AuthorController extends Controller
{
    public function __construct(private readonly AuthorService $author)
    {
    }

    public function index()
    {
        return $this->author->index();
    }

    public function store(AuthorRequest $request)
    {
        return $this->author->store($request);
    }

    public function show($id)
    {
        return $this->author->show($id);
    }

    public function update(AuthorRequest $request,$id)
    {
        return $this->author->update($request,$id);
    }

    public function destroy($id)
    {
        return $this->author->destroy($id);
    }

}
