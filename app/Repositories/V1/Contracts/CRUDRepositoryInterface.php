<?php

namespace App\Repositories\V1\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CRUDRepositoryInterface
{
    public function getAll(int $perPage): LengthAwarePaginator;

    public function getById(int $id): Model|Builder;

    public function create(array $requestData): Model|Builder;

    public function update(int $id, array $requestData): bool;

    public function delete(int $id): bool;
}
