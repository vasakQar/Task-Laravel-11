<?php

namespace App\Repositories\V1\Contracts;

interface ReportRepositoryInterface
{
    public function getAll(): object;

    public function getReportsByWebsite(int $websiteId): object;
}
