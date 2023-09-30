<?php

namespace App\Providers;

use App\Iface\BookRepositoryInterface;
use App\Iface\BookReservationRepositoryInterface;
use App\Iface\UserRepositoryInterface;
use App\Repository\BookRepository;
use App\Repository\BookReservationRepository;
use App\Repository\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(BookReservationRepositoryInterface::class, BookReservationRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
