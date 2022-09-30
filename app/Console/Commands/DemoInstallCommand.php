<?php

namespace App\Console\Commands;

use App\Facades\Env;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DemoInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Demo Install Command';

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
        //APP_DEMO = true
        Env::update([
            'APP_ENV'           => 'local',
            'APP_DEBUG'         => 'false',
            "SESSION_DRIVER"    => "database",
            'APP_INSTALLED'     => "true",
            'APP_DEMO'          => "true",
        ]);

        Artisan::call('migrate:fresh', ['--seed' => true]);

        $this->info("Wokoya Demo installation complete.");
        return 0;
    }
}
