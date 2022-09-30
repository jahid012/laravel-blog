<?php

namespace Plugins\Contact\Providers;

use Illuminate\Support\ServiceProvider;

class ContactServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'contact');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'contact');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
