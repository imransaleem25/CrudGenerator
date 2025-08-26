<?php
namespace Imransaleem\CrudGenerator\Console\Commands;

use Illuminate\Console\Command;
use Imransaleem\CrudGenerator\Models\CrudStat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RefreshCrudStatsCommand extends Command
{
    protected $signature = 'crud:stats';
    protected $description = 'Refresh CRUD stats with record counts';

    public function handle()
    {
        $stats = CrudStat::all();

        foreach ($stats as $stat) {
            if (Schema::hasTable($stat->table_name)) {
                $count = DB::table($stat->table_name)->count();
                $stat->update(['records_count' => $count]);
                $this->info("Updated {$stat->table_name}: {$count} records");
            }
        }

        $this->info('CRUD stats refreshed!');
    }
}
