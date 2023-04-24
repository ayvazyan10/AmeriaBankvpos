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
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

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
        require_once __DIR__ . '/helper.php';

        $this->mergeConfigFrom(__DIR__ . '/../config/ameriabankvpos.php', 'ameriabankvpos');

        // Register the service the package provides.
        $this->app->bind('ameriabank-vpos', function ($app) {
            return new AmeriaBankVPOS;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides(): array
    {
        return ['ameriabank-vpos'];
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
            __DIR__ . '/../config/ameriabankvpos.php' => config_path('ameriabankvpos.php'),
        ], 'ameriabankvpos.config');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'ameriabankvpos.migrations');
    }
}
