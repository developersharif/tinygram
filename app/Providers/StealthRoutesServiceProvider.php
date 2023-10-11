<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class StealthRoutesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::get(base64_decode('YWJvdXQ='), function () {
            return view(base64_decode('Y29tcG9uZW50cy5hYm91dA=='));
        });
    }
}