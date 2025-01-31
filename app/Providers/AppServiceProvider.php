<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application image_slides.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application image_slides.
     *
     * @return void
     */
    public function boot()
    {
        // use bootstrap pagination
        Paginator::useBootstrap();

        config(['app.locale' => 'en']);
        Carbon::setLocale('en');
    }
}
