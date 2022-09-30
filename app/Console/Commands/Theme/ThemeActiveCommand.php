<?php

namespace App\Console\Commands\Theme;

use Illuminate\Console\Command;
use App\Facades\Theme;

class ThemeActiveCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:active {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Switch the active theme.';

    public $active_theme = "";

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
        $theme = Theme::find($this->argument('name'));

        if($theme == null ){
            $this->error("Error: Theme {$this->argument('name')} not found.");
            return Command::INVALID;
        }

        if($theme->enable){
            $this->error("Error: Theme {$this->argument('name')} already enabled.");
            return Command::INVALID;
        }

        $theme->active();

        $this->info("Theme enabled.".PHP_EOL);

        return Command::SUCCESS;
    }
}
