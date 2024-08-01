<?php

namespace App;

trait ReportsTotalTrait
{
    private function getReportsTotal(array $reports): array
    {
        return [
            'sum' => array_sum(array_column($reports, 'revenue')),
            'impressions' => array_sum(array_column($reports, 'impressions')),
            'clicks' => array_sum(array_column($reports, 'clicks')),
            'cpm' => array_sum(array_column($reports, 'cpm')),
        ];
    }
}
