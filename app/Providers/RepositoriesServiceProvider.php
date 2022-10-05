<?php

namespace App\Providers;

use App\Repositories\HallRepository\EloquentHallRepository;
use App\Repositories\HallRepository\HallRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(HallRepositoryInterface::class, EloquentHallRepository::class);
    }
}
