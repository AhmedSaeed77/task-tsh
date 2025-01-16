<?php

namespace App\Repository;

use App\Repository\RepositoryInterface;
use Closure;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

abstract class Repository implements RepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function index(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model->get($columns);
    }

    public function get($column1,$column2)
    {
        return $this->model->where($column1, $column2)->first();
    }

    public function find($modelId): ?Model
    {
        return $this->model->findOrFail($modelId);
    }

    public function create(array $payload): ?Model
    {
        $model = $this->model->create($payload);

        return $model->fresh();
    }

    public function update($modelId, array $payload): bool
    {
        $model = $this->find($modelId);
        return $model->update($payload);
    }

    public function delete($modelId, array $filesFields = []): bool
    {
        $model = $this->find($modelId);
        foreach ($filesFields as $field) {
            if ($model->$field !== null) {
                $this->deleteFile($model->$field);
            }
        }
        return $model->delete();
    }

    public function paginate(int $perPage = 10, array $relations = [], $orderBy = 'ASC', $columns = ['*'])
    {
        return $this->model::query()->select($columns)->with($relations)->orderBy('id', $orderBy)->paginate($perPage);
    }

}
