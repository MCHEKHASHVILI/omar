<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Repositories\TestRepository\{Interfaces\TestRepositoryInterface, TestRepository};
use App\Repositories\FirebaseRepository\{FirebaseRepository, Interfaces\FirebaseRepositoryInterface};
use App\Repositories\UsersRepository\{UsersRepository, Interfaces\UsersRepositoryInterface};
use App\Repositories\RecipeRepository\{
    RecipeRepository,
    Interfaces\RecipeRepositoryInterface
};
use App\Repositories\TrainingRepository\{
    TrainingRepository,
    Interfaces\TrainingRepositoryInterface
};

use App\Repositories\HomeRepository\{
    HomeRepository,
    Interfaces\HomeRepositoryInterface,
};




class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(TestRepositoryInterface::class, TestRepository::class);
        $this->app->bind(FirebaseRepositoryInterface::class, FirebaseRepository::class);
        $this->app->bind(UsersRepositoryInterface::class, UsersRepository::class);
        $this->app->bind(RecipeRepositoryInterface::class, RecipeRepository::class);
        $this->app->bind(TrainingRepositoryInterface::class, TrainingRepository::class);
        $this->app->bind(HomeRepositoryInterface::class, HomeRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
