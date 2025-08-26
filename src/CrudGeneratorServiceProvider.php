<?php

namespace Imransaleem\CrudGenerator;

use Illuminate\Support\ServiceProvider;
use Imransaleem\CrudGenerator\Console\Commands\CrudMakeCommand;
use Imransaleem\CrudGenerator\Console\Commands\RefreshCrudStatsCommand;

class  CrudGeneratorServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Load package routes
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/stubs/views', 'crud-generator');

        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudMakeCommand::class,
                RefreshCrudStatsCommand::class,
            ]);
        }
    }
}
