<?php

namespace App\Providers;

use App\Helpers\CAuth;
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
//        $this->app->singleton(CAuth::class, function () {
//            return new CAuth(-1);
//        });
        $this->app->singleton('App\Helpers\CAuth');
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
