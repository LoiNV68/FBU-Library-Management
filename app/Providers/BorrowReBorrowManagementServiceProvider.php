<?php

namespace App\Providers;

use App\Services\BorrowReBorrowManagementService;
use Illuminate\Support\ServiceProvider;

class BorrowReBorrowManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BorrowReBorrowManagementService::class, function ($app) {
            return new BorrowReBorrowManagementService();
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
