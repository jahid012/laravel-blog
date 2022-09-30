<?php

namespace App\Console\Commands\Plugin;

use Illuminate\Console\Command;
use Symfony\Component\Finder\Finder;

class PluginMigrateCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:migrate {--database= : The database connection to use}
                {name : Name of the addon}
                {--seed : Indicates if the seed task should be re-run}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the database migrations';

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


        $finder = new Finder();
        // find all files in the current directory
        $path = $this->addon()->path. '/database/migrations';

        $finder->files()->in($path);
        $path = [];
        // check if there are any search results
        if ($finder->hasResults()) {
            foreach ($finder as $file) {
                $path[] = str_replace(base_path(). '/', '', $file->getRealPath());
            }
        }

        // migration
        $this->call('migrate', [
            '--database' => $this->option('database'),
            '--force' => true,
            '--path' => $path,
            '--step' => true,
        ]);

        return 0;
    }
}
