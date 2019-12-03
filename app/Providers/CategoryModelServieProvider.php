<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class CategoryModelServieProvider extends ServiceProvider
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
        // NOTE Menambahkan Oberserver Category dengan dedicated service providers agar lebih rapi
        // NOTE Sebenarnya dapat langsung ditambahkan pada class AppServiceProviders tapi nanti jadinya tidak rapi
        \App\Category::observe(\App\Observers\CategoryObserver::class);
    }
}
