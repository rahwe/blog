<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // we aliases badge 
        Blade::component('components.badge', 'badge');
        Blade::component('components.post_date_auther', 'datetime');
        //Blade::component('components.tag', 'tags');
        Blade::component('components.tag', 'tags');
    }
}
