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
        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                CrudMakeCommand::class,
                RefreshCrudStatsCommand::class,
            ]);
        }
    }
}
