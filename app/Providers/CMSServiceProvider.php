<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Support\Theme;
use App\Models\ThemeOption;
use App\Support\Menu;
use App\Support\Toastr;
use App\Support\Alert;
use App\Support\ThemeManifest;

class CMSServiceProvider extends ServiceProvider
{

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('toastr', function ($app) {
            return new Toastr($app['session'], $app['config']);
        });

        // added theme singleton
        $this->app->singleton('themes', function ($app){
            return new ThemeManifest($app['files']);
        });

        $this->app->bind('theme', Theme::class);
        $this->app->bind('themeOption', ThemeOption::class);
        $this->app->bind('menu', Menu::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->initTheme();
        $this->initPlugin();

        // singleton
        $this->app->singleton('alert', function () {
            return $this->app->make(Alert::class);
        });
    }

    /**
     * Init Theme
     */
    public function initTheme()
    {
        $theme = $this->app->themes->current();
        $this->loadViewsFrom( $theme['full_path']. '/views', 'theme');
        $this->loadTranslationsFrom( $theme['full_path']. '/lang', 'theme');
    }


    /**
     * Init Plugin
     */
    public function initPlugin()
    {

    }

    /**
     * Get the services provider by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ['alert'];
    }

}
