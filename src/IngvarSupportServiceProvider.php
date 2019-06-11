<?php

namespace Ingvar\Support;

use Illuminate\Support\ServiceProvider;

class IngvarSupportServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadTranslationsFrom(__DIR__.'/lang', 'igs');
        $this->loadViewsFrom(__DIR__.'/views', 'igs');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
