<?php

namespace App\Services\V1\Contracts;

use App\Models\Website;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface WebsiteServiceInterface
{
    public function getAll(array $requestData): LengthAwarePaginator;

    public function getById(int $id): Model|Builder;

    public function create(array $requestData): Model|Builder;

    public function update(Website $website, array $requestData): bool;

    public function delete(int $id): bool;
}
