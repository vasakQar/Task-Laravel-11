<?php

namespace App\Repositories\V1;

use App\Models\Website;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\V1\Contracts\ReportRepositoryInterface;
use App\Repositories\V1\Contracts\WebsiteRepositoryInterface;

class WebsiteRepository implements WebsiteRepositoryInterface
{
    protected Website $model;

    protected ReportRepositoryInterface $reportRepository;

    public function __construct(Website $model, ReportRepositoryInterface $reportRepository)
    {
        $this->model = $model;
        $this->reportRepository = $reportRepository;
    }

    public function getAll(int $perPage): LengthAwarePaginator
    {
        return $this->model->newQuery()->paginate($perPage);
    }

    public function getById(int $id): Model|Builder
    {
        return $this->model->newQuery()
            ->findOrFail($id);
    }

    public function create(array $requestData): Model|Builder
    {
        return $this->model->newQuery()
            ->create($requestData);
    }

    public function update(int $id, array $requestData): bool
    {
        return $this->getById($id)
            ->update($requestData);
    }

    public function delete(int $id): bool
    {
        return $this->getById($id)
            ->delete();
    }

    public function websiteReports(int $id): object
    {
        $this->getById($id);

        return $this->reportRepository->getReportsByWebsite($id);
    }
}
