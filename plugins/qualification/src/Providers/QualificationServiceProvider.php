<?php

namespace Plugins\Qualification\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class QualificationServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'qualification');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'qualification');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
