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
        $this->publishes([
            __DIR__ . '/config/support-service.php' => base_path('config/support-service.php'),
        ], 'igs_config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/support-service'),
        ], 'igs_public');

        $this->publishes([
            __DIR__.'/views'  => base_path('resources/views/vendor/support-service'),
        ], 'igs_view');

        $this->publishes([
            __DIR__.'/lang' => resource_path('lang/vendor/support-service'),
        ], 'igs_lang');
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
