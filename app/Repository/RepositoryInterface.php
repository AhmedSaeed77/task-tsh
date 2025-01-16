<?php

namespace App\Repository;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function index(array $columns = ['*'], array $relations = []): Collection;

    public function get($column1,$column2);

    public function find($modelId): ?Model;

    public function create(array $payload): ?Model;

    public function update($modelId, array $payload): bool;

    public function delete($modelId, array $filesFields = []): bool;

    public function paginate(int $perPage = 10, array $relations = [], $orderBy = 'ASC', $columns = ['*']);

}
