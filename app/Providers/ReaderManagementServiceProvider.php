<?php

namespace App\Providers;

use App\Services\ReaderManagementService;
use Illuminate\Support\ServiceProvider;

class ReaderManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(ReaderManagementService::class, function ($app) {
            return new ReaderManagementService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
