<?php

namespace App\Providers;

use App\Repositories\ArtistRepository\ArtistRepositoryInterface;
use App\Repositories\ArtistRepository\EloquentArtistRepository;
use App\Repositories\ComplexRepository\ComplexRepositoryInterface;
use App\Repositories\ComplexRepository\EloquentComplexRepository;
use App\Repositories\EventRepository\EloquentEventRepository;
use App\Repositories\EventRepository\EventRepositoryInterface;
use App\Repositories\HallRepository\EloquentHallRepository;
use App\Repositories\HallRepository\HallRepositoryInterface;
use App\Repositories\SeatRepository\EloquentSeatRepository;
use App\Repositories\SeatRepository\SeatRepositoryInterface;
use App\Repositories\SectionRepository\EloquentSectionRepository;
use App\Repositories\SectionRepository\SectionRepositoryInterface;
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
        $this->app->bind(ComplexRepositoryInterface::class, EloquentComplexRepository::class);
        $this->app->bind(HallRepositoryInterface::class, EloquentHallRepository::class);
        $this->app->bind(SectionRepositoryInterface::class, EloquentSectionRepository::class);
        $this->app->bind(SeatRepositoryInterface::class, EloquentSeatRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EloquentEventRepository::class);
        $this->app->bind(ArtistRepositoryInterface::class, EloquentArtistRepository::class);
    }
}
