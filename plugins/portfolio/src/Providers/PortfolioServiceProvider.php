<?php

namespace Plugins\Portfolio\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class PortfolioServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'portfolio');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'portfolio');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
