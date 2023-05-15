<?php

namespace Intellicore\Pin;

use Illuminate\Support\ServiceProvider;

class PinServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->configurePublishing();
    }

    public function configurePublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/Pin.php' => config_path('pin.php'),
        ], 'config');
    }


    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/Pin.php', 'pin');

        // Register the service the package provides.
        $this->app->singleton('pin', function ($app) {
            return new Pin();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['pin'];
    }
}
