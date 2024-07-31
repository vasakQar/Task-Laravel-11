<?php

namespace App\Services\V1\Contracts;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface ReportServiceInterface
{
    public function getAll(): array;

    public function getById(int $id): Model|Builder;

    public function create(array $requestData): Model|Builder;

    public function update(int $id, array $requestData): bool;

    public function delete(int $id): bool;
}
