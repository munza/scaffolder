<?php

namespace Munza\Scaffolder;

use Illuminate\Support\ServiceProvider;
use Munza\Scaffolder\Commands\MakeStub;
use Munza\Scaffolder\Commands\MakeGenerator;

class ScaffolderServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../resources/config/scaffolder.php' => base_path('config/scaffolder.php'),
        ], 'config');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        if (config('scaffolder')) {
            $this->mergeConfigFrom(
                __DIR__.'/../resources/config/scaffolder.php',
                'scaffolder'
            );
        }

        if ($this->app->runningInConsole()) {
            $this->loadViewsFrom(__DIR__.'/../resources/stubs', 'scaffolder');

            $this->commands([
                MakeStub::class,
                MakeGenerator::class,
            ]);

            $this->loadViewsFrom(config('scaffolder.paths.stubs'), 'scaffolder');
        }
    }
}
