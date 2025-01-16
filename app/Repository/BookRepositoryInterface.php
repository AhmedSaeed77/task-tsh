<?php

namespace App\Repository;

interface BookRepositoryInterface
{
    public function index();
    public function store($request);
    public function show($id);
    public function update($request,$id);
    public function destroy($id);
    public function find($id);
}
