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

        return [
            'data' => $reports,
            'total' => $total
        ];
    }

    public function getById(int $id): Model|Builder
    {
        // TODO: Implement getById() method.
    }

    public function create(array $requestData): Model|Builder
    {
        // TODO: Implement create() method.
    }

    public function update(int $id, array $requestData): bool
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id): bool
    {
        // TODO: Implement delete() method.
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
