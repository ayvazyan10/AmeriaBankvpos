<?php

namespace Ayvazyan10\AmeriaBankVPOS;

use Illuminate\Support\ServiceProvider;

class AmeriaBankVPOSServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'ayvazyan10');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'ayvazyan10');
         $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ameriabankvpos.php', 'ameriabankvpos');

        // Register the service the package provides.
        $this->app->singleton('ameriabankvpos', function ($app) {
            return new AmeriaBankVPOS;
        });

        $this->app->alias(\Ayvazyan10\AmeriaBankVPOS\Facades\AmeriaBankVPOS::class, 'ameriabankvpos');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['ameriabankvpos'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/ameriabankvpos.php' => config_path('ameriabankvpos.php'),
        ], 'ameriabankvpos.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/ayvazyan10'),
        ], 'ameriabankvpos.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/ayvazyan10'),
        ], 'ameriabankvpos.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/ayvazyan10'),
        ], 'ameriabankvpos.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
