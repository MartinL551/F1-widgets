<?php

namespace App\Providers;

use App\Service\NationalDishService;
use Illuminate\Support\ServiceProvider;

class NationalDishServiceProvider extends ServiceProvider
{
      /**
     * Bootstrap services.
     */
    public function register(): void
    {
        $this->app->singleton(NationalDishService::class, function () {
            return new NationalDishService();
        });
    }
}
