<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.datetime', 'datetime');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
