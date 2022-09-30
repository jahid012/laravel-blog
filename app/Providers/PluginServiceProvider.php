<?php

namespace App\Providers;

use App\Support\Plugin;
use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;

class PluginServiceProvider extends ServiceProvider
{

    /**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * All of the registered booting Plugins.
     *
     * @var array
     */
    protected $plugins = ['providers' => [], 'alias' => []];

        /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // bind plugins grobaly
        $this->app->bind('plugin', Plugin::class);
        $this->plugins = $this->app->plugin->getCache();

        // $this->app->singleton('plugin', function ($app) {
        //     return new Plugin($app);
        // });

        /**
         * Register Plugins providers.
         */
        if(isset($this->plugins['providers']) == true && !empty($this->plugins['providers']) ){
            $this->registerPlugins($this->plugins['providers']);
        }

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }


    /**
     * Register Plugins providers.
     */
    public function registerPlugins($providers)
    {
        foreach ($providers as $provider) {
            if(class_exists("{$provider}")){
                $this->app->register("{$provider}");
            }
        }
    }

}
