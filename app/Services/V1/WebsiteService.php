<?php

namespace App\Services\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use App\Services\V1\Contracts\WebsiteServiceInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\Repositories\V1\Contracts\CRUDRepositoryInterface;

class WebsiteService implements WebsiteServiceInterface
{
    protected CRUDRepositoryInterface $websiteRepository;

    public function __construct(CRUDRepositoryInterface $websiteRepository)
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
        // TODO: Implement getById() method.
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
}
