<?php

namespace App\Repositories\V1;

use App\Models\Report;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Repositories\V1\Contracts\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    protected Report $model;

    public function __construct(Report $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
        return $this->model->newQuery()
            ->select(
                DB::raw('DATE(date) as date'),
                DB::raw('SUM(revenue) as revenue'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('SUM(clicks) as clicks'),
                DB::raw('CASE WHEN SUM(impressions) > 0 THEN (SUM(revenue) * 1000 / SUM(impressions)) ELSE 0 END as cpm')
            )
            ->groupBy('date')
            ->get();
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
