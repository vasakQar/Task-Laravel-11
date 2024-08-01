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
                DB::raw('FORMAT(SUM(revenue), 2) as revenue'),
                DB::raw('FORMAT(SUM(impressions), 2) as impressions'),
                DB::raw('FORMAT(SUM(clicks), 2) as clicks'),
                DB::raw('FORMAT(CASE WHEN SUM(impressions) > 0 THEN (SUM(revenue) * 1000 / SUM(impressions)) ELSE 0 END, 2) as cpm')
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
