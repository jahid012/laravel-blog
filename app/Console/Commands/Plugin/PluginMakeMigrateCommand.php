<?php

namespace App\Console\Commands\Plugin;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class PluginMakeMigrateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */

    protected $signature = 'plugin:make-migration {migration : The name of the migration}
        {--table= : The table to migrate}
        {name : The addon Name}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        parent::handle();

        $name = $this->argument('migration');

        if(!Str::contains('create_', $name) && !Str::contains('_table', $name)){
            $name = Str::plural($name);
            $name = "create_{$name}_table";
        }

        $path = $this->addon()->path.'/database/migrations';
        $this->call("make:migration", [
            'name' => $name,
            '--path' => $path
        ]);
        return 0;
    }
}
