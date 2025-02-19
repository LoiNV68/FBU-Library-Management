<?php

namespace App\Providers;

use App\Services\LibraryStatisticsService;
use Illuminate\Support\ServiceProvider;

class LibraryStatisticsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(LibraryStatisticsService::class, function ($app) {
            return new LibraryStatisticsService();
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
