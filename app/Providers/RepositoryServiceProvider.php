<?php

namespace App\Providers;

use App\Interfaces\MahasiswaInterfaces;
use App\Repositories\MahasiswaRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(MahasiswaInterfaces::class, MahasiswaRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
