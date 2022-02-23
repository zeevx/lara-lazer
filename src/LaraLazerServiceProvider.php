<?php

namespace Zeevx\LaraLazer;
use Illuminate\Support\ServiceProvider;
use Zeevx\LaraLazer\Command\LaraLazerCommand;

class LaraLazerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if (file_exists($file = __DIR__ . '/helper.php')) {
            require $file;
        }

        if ($this->app->runningInConsole()) {
            $this->commands([
                LaraLazerCommand::class,
            ]);
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('lara-lazer.php'),
            ], 'lara-lazer-config');
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'lara-lazer');

        // Register the main class to use with the facade
        $this->app->singleton('lazerpay', function () {
            return new LaraLazer;
        });
    }
}
