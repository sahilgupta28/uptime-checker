<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Website\WebsiteInterface;
use App\Repositories\Website\WebsiteRepository;
use App\Repositories\TestLog\TestLogInterface;
use App\Repositories\TestLog\TestLogRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(UserInterface::class, UserRepository::class);
        $this->app->singleton(WebsiteInterface::class, WebsiteRepository::class);
        $this->app->singleton(TestLogInterface::class, TestLogRepository::class);
    }
}
