<?php

namespace App\Providers;

use App\Services\BookManagementService;
use Illuminate\Support\ServiceProvider;

class BookManagementServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BookManagementService::class, function ($app) {
            return new BookManagementService();
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
