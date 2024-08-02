<?php

namespace App\Traits;

trait ReportsTotalTrait
{
    private function getReportsTotal(array $reports): array
    {
        return [
            'sum' => number_format(array_sum(array_column($reports, 'revenue')), 2),
            'impressions' => number_format(array_sum(array_column($reports, 'impressions')), 2),
            'clicks' => number_format(array_sum(array_column($reports, 'clicks')), 2),
            'cpm' => number_format(array_sum(array_column($reports, 'cpm')), 2),
        ];
    }
}
