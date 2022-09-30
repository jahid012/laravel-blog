<?php

namespace Plugins\Skill\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class SkillServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        $this->loadTranslationsFrom(__DIR__.'/../../resources/lang', 'skill');
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'skill');
        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
