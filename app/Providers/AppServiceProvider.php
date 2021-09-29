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
    }
    public $bindings = [
        'App\Repositories\Contracts\UserRepositoryInterface'::class
        => 'App\Repositories\Eloquents\UserRepository'::class,

        'App\Repositories\Contracts\SubjectRepositoryInterface'::class
        => 'App\Repositories\Eloquents\SubjectRepository'::class,

        'App\Repositories\Contracts\PointRepositoryInterface'::class
        => 'App\Repositories\Eloquents\PointRepository'::class,

        'App\Repositories\Contracts\ClassRepositoryInterface'::class
        => 'App\Repositories\Eloquents\ClassRepository'::class
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}