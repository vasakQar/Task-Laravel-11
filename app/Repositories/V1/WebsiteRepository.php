<?php

namespace App\Repositories\V1;

use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\V1\Contracts\CRUDRepositoryInterface;

class WebsiteRepository implements CRUDRepositoryInterface
{
    protected Website $model;

    public function __construct(Website $model)
    {
        $this->model = $model;
    }

    public function getAll(int $perPage): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate($perPage);
    }

    public function getById(int $id): Model|Builder
    {
        return $this->model->newQuery()
            ->findOrFail($id);
    }

    public function create(array $requestData): Model|Builder
    {
        return $this->model->newQuery()
            ->create($requestData);
    }

    public function update(int $id, array $requestData): bool
    {
        return $this->getById($id)
            ->update($requestData);
    }

    public function delete(int $id): bool
    {
        return $this->getById($id)
            ->delete();
    }
}
