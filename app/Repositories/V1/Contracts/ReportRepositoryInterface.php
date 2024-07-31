<?php

namespace App\Repositories\V1\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReportRepositoryInterface
{
    public function getAll(): Collection;

    public function getById(int $id): Model|Builder;

    public function create(array $requestData): Model|Builder;

    public function update(int $id, array $requestData): bool;

    public function delete(int $id): bool;
}
