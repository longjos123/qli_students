<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\Contracts\UserRepositoryInterface',
            'App\Repositories\Eloquents\UserRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\SubjectRepositoryInterface',
            'App\Repositories\Eloquents\SubjectRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\PointRepositoryInterface',
            'App\Repositories\Eloquents\PointRepository'
        );
        $this->app->bind(
            'App\Repositories\Contracts\ClassRepositoryInterface',
            'App\Repositories\Eloquents\ClassRepository'
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}