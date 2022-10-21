<?php

namespace App\Providers;

use App\Repository\BaseRepository\BaseRepository;
use App\Repository\BaseRepository\IBaseRepository;
use App\Repository\UserRepository\IUserRepository;
use App\Repository\UserRepository\UserRepository;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IBaseRepository::class, BaseRepository::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
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
