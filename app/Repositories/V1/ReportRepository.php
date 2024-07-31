<?php

namespace App\Repositories\V1;

use App\Models\Report;
use Illuminate\Support\Facades\DB;
use App\Repositories\V1\Contracts\ReportRepositoryInterface;

class ReportRepository implements ReportRepositoryInterface
{
    protected Report $model;

    public function __construct(Report $model)
    {
        $this->model = $model;
    }

    public function getAll(): object
    {
        return $this->commonQuery();
    }

    public function getReportsByWebsite(int $websiteId): object
    {
        return $this->commonQuery($websiteId);
    }

    private function commonQuery($websiteId = null)
    {
        return $this->model->newQuery()
            ->select(
                DB::raw('DATE(date) as date'),
                DB::raw('SUM(revenue) as revenue'),
                DB::raw('SUM(impressions) as impressions'),
                DB::raw('SUM(clicks) as clicks'),
                DB::raw('CASE WHEN SUM(impressions) > 0 THEN (SUM(revenue) * 1000 / SUM(impressions)) ELSE 0 END as cpm')
            )
            ->when($websiteId, function ($query) use ($websiteId) {
                $query->where('website_id', $websiteId);
            })
            ->groupBy('date')
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item->date => [
                    'revenue' => $item->revenue,
                    'impressions' => $item->impressions,
                    'clicks' => $item->clicks,
                    'cpm' => $item->cpm
                ]];
            });
    }
}
