<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\FirebaseCloudConnection;
use App\FirebaseConnection;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FirebaseConnection::class, function () {
            return new FirebaseConnection();
        });

        $this->app->singleton(FirebaseCloudConnection::class, function () {
            return new FirebaseCloudConnection();
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
