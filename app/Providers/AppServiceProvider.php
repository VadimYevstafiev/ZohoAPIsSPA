<?php

namespace App\Providers;

use App\Services\Contracts\APIserviceContract;
use App\Services\ZohoService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        APIserviceContract::class => ZohoService::class
    ];
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
