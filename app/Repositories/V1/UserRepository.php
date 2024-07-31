<?php

namespace App\Repositories\V1;

use App\Models\User;
use App\Repositories\V1\Contracts\CRUDRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements CRUDRepositoryInterface
{
    protected User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll(int $perPage): LengthAwarePaginator
    {
        // TODO: Implement getAll() method.
    }

    public function getById(int $id): Model|Builder
    {
        // TODO: Implement getById() method.
    }

    public function create(array $requestData): Model|Builder
    {
        return $this->model->newQuery()
            ->create($requestData);
    }

    public function update(int $id, array $requestData): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
    }
}
