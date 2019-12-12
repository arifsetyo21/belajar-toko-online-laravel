<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class OrderDetailModelServiceProvider extends ServiceProvider
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
        /* NOTE Mendaftarkan observer pada service provider untuk mengisi total_price dan total payment */
        \App\OrderDetail::observe(\App\Observers\OrderDetailObserver::class);
    }
}
