<?php

namespace Plugins\Service\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'service');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'service');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
