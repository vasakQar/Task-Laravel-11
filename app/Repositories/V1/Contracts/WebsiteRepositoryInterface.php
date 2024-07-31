<?php

namespace App\Repositories\V1\Contracts;

interface WebsiteRepositoryInterface
{
    public function websiteReports(int $id): object;
}
