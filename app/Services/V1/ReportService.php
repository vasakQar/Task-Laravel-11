<?php

namespace App\Services\V1;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\V1\ReportRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use App\Services\V1\Contracts\ReportServiceInterface;
use function Laravel\Prompts\select;

class ReportService implements ReportServiceInterface
{
    protected ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getAll(): array
    {
        $reports = $this->reportRepository->getAll();
        $total = self::getReportsTotal($reports);
        $reports['total'] = $total;

        return [
            'data' => $reports
        ];
    }

    private static function getReportsTotal($reports): array
    {
        return [
            'sum' => array_sum(array_column($reports->toArray(), 'revenue')),
            'impressions' => array_sum(array_column($reports->toArray(), 'impressions')),
            'clicks' => array_sum(array_column($reports->toArray(), 'clicks')),
            'cpm' => array_sum(array_column($reports->toArray(), 'cpm')),
        ];
    }
}
