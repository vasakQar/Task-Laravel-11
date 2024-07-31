<?php

namespace App\Repositories\V1\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ReportRepositoryInterface
{
    public function getAll(): Collection;
}
