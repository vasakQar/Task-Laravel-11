<?php

namespace App\Services\V1;

use App\ReportsTotalTrait;
use App\Repositories\V1\ReportRepository;
use App\Services\V1\Contracts\ReportServiceInterface;

class ReportService implements ReportServiceInterface
{
    use ReportsTotalTrait;

    protected ReportRepository $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function getAll(): array
    {
        $reports = $this->reportRepository->getAll();
        $reportsArray = $reports->toArray();
        $reportsArray['total'] = $this->getReportsTotal($reportsArray);

        return [
            'data' => $reportsArray
        ];
    }
}
