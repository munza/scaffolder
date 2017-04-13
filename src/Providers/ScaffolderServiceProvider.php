<?php

namespace Munza\Scaffolder\Providers;

use Illuminate\Support\ServiceProvider;
use Munza\Scaffolder\Commands\MakeGenerator;

class ScaffolderServiceProvider extends ServiceProvider
{
    /**
     * Console class contact.
     *
     * @var \Illuminate\Contracts\Console\Kernel
     */
    private $console;

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        $this->console = app('Illuminate\Contracts\Console\Kernel');

        parent::__construct($app);
    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../resources/config/scaffolder.php' => base_path('config/scaffolder.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Load the config
        if (config('scaffolder')) {
            $this->mergeConfigFrom(
                __DIR__.'/../../resources/config/scaffolder.php',
                'scaffolder'
            );
        }

        // Register the commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeGenerator::class,
            ]);
        }
    }
}
