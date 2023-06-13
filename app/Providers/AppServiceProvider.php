<?php

namespace App\Providers;

use App\Services\Impl\ArticleServiceImpl;
use App\Services\Impl\UserServiceImpl;
use App\Services\Interfaces\ArticleService;
use App\Services\Interfaces\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserService::class, UserServiceImpl::class);
        $this->app->bind(ArticleService::class, ArticleServiceImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
