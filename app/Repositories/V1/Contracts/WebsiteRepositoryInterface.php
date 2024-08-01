<?php

namespace App\Repositories\V1\Contracts;

interface WebsiteRepositoryInterface extends CRUDRepositoryInterface
{
    public function websiteReports(int $id): object;
}
