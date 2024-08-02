<?php

namespace App\Services\V1;

use App\Traits\ReportsTotalTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\V1\Contracts\WebsiteServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\V1\Contracts\WebsiteRepositoryInterface;

class WebsiteService implements WebsiteServiceInterface
{
    use ReportsTotalTrait;

    protected WebsiteRepositoryInterface $websiteRepository;

    public function __construct(WebsiteRepositoryInterface $websiteRepository)
    {
        $this->websiteRepository = $websiteRepository;
    }

    public function getAll(array $requestData): LengthAwarePaginator
    {
        $perPage = $requestData['per_page'] ?? 20;

        return $this->websiteRepository->getAll($perPage);
    }

    public function getById(int $id): Model|Builder
    {
        return $this->websiteRepository->getById($id);
    }

    public function create(array $requestData): Model|Builder
    {
        return $this->websiteRepository->create($requestData);
    }

    public function update(int $id, array $requestData): bool
    {
        return $this->websiteRepository->update($id, $requestData);
    }

    public function delete(int $id): bool
    {
        return $this->websiteRepository->delete($id);
    }

    public function websiteReports(int $id): array
    {
        $websiteReports = $this->websiteRepository->websiteReports($id);
        $reportsArray = $websiteReports->toArray();
        $reportsArray['total'] = $this->getReportsTotal($reportsArray);

        return [
            'data' => $reportsArray
        ];
    }
}
