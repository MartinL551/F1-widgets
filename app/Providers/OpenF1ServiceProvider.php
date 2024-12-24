<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Service\OpenF1;

class OpenF1ServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function register(): void
    {
        $this->app->singleton(OpenF1::class, function () {
            return new OpenF1(config('openf1.api_base_url') ?: '');
        });
    }
}
