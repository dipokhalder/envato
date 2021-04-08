<?php

namespace Dipokhalder\Envato;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class EnvatoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $source = realpath(__DIR__ . '/config/envato.php');
        $this->publishes([ $source => config_path('envato.php') ]);
        $this->mergeConfigFrom($source, 'envato');
    }

    public function register()
    {
        $this->app->singleton('envato', function( Container $app ) {
            return new Envato($app['config']->get('envato'));
        });
        $this->app->alias('envato', Envato::class);
    }

}
