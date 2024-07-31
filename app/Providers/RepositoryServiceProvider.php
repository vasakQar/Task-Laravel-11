<?php

namespace App\Providers;

use App\Repositories\V1\Contracts\ReportRepositoryInterface;
use App\Repositories\V1\ReportRepository;
use App\Repositories\V1\WebsiteRepository;
use App\Services\V1\Contracts\ReportServiceInterface;
use App\Services\V1\Contracts\WebsiteServiceInterface;
use App\Services\V1\ReportService;
use App\Services\V1\UserService;
use App\Repositories\V1\UserRepository;
use App\Services\V1\WebsiteService;
use Illuminate\Support\ServiceProvider;
use App\Services\V1\Contracts\UserServiceInterface;
use App\Repositories\V1\Contracts\CRUDRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // User
        $this->app->when(UserService::class)
            ->needs(CRUDRepositoryInterface::class)
            ->give(UserRepository::class);

        $this->app->bind(UserServiceInterface::class, UserService::class);

        // Website
        $this->app->when(WebsiteService::class)
            ->needs(CRUDRepositoryInterface::class)
            ->give(WebsiteRepository::class);

        $this->app->bind(WebsiteServiceInterface::class, WebsiteService::class);

        // Report
//        $this->app->when(ReportService::class)
//            ->needs(CRUDRepositoryInterface::class)
//            ->give(ReportRepository::class);

        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);
        $this->app->bind(ReportServiceInterface::class, ReportService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
