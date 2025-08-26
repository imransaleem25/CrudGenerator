<?php

namespace Imransaleem\CrudGenerator\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Imransaleem\CrudGenerator\Models\CrudStat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CrudMakeCommand extends Command
{
    protected $signature = 'crud:make {name} {--model=}';
    protected $description = 'Generate CRUD repository, service, controller and views';

    public function handle()
    {
        $name  = $this->argument('name');
        $model = $this->option('model') ?? $name;

        $stubs = [
            'repository' => 'repository.stub',
            'service'    => 'service.stub',
            'controller' => 'controller.stub',
        ];

        foreach ($stubs as $type => $stubFile) {
            $stub = file_get_contents(__DIR__ . "/../../stubs/{$stubFile}");
            $content = str_replace(
                ['DummyClass', 'DummyNamespace', 'DummyFullModelClass'],
                [$name, "App", "App\\Models\\$model"],
                $stub
            );

            $path = app_path(
                ($type === 'controller'
                    ? "Http/Controllers"
                    : ($type === 'repository' ? "Repositories" : "Services"))
                . "/{$name}" . ucfirst($type) . ".php"
            );

            (new Filesystem)->ensureDirectoryExists(dirname($path));
            file_put_contents($path, $content);
            $this->info(ucfirst($type) . " created: $path");
        }

        // Create views
        $viewPath = resource_path("views/{$name}");
        (new Filesystem)->ensureDirectoryExists($viewPath);

        $viewStubs = ['index', 'create', 'edit', 'show'];
        $fields = ['title', 'description']; // default fields

        foreach ($viewStubs as $view) {
            $stub = file_get_contents(__DIR__ . "/../../stubs/views/{$view}.stub");
            $content = str_replace(
                ['{{name}}', '{{namePlural}}', '{{fields}}'],
                [$name, Str::plural($name), implode(',', $fields)],
                $stub
            );
            file_put_contents("{$viewPath}/{$view}.blade.php", $content);
            $this->info("View created: {$viewPath}/{$view}.blade.php");
        }

        // Stats logging
        $modelName = $model;
        $table = Str::snake(Str::pluralStudly($model));

        $this->info("CRUD for {$modelName} generated successfully!");

        $stat = CrudStat::firstOrCreate(
            ['model_name' => $modelName, 'table_name' => $table],
            ['generated_count' => 0]
        );

        $stat->increment('generated_count');

        if (Schema::hasTable($table)) {
            $stat->records_count = DB::table($table)->count();
            $stat->save();
        }
    }
}
