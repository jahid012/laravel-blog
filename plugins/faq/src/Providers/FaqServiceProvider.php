<?php

namespace Plugins\Faq\Providers;

use Illuminate\Support\ServiceProvider;

class FaqServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'faq');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'faq');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
