<?php

namespace App\Providers;

use App\Isop\Isop;
use Illuminate\Support\ServiceProvider;

class IsopServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('isop', function () {
            return new Isop();
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
