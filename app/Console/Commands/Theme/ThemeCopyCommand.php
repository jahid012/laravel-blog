<?php

namespace App\Console\Commands\Theme;

use Illuminate\Console\Command;
use App\Facades\Theme;
use Illuminate\Support\Facades\File;

class ThemeCopyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:copy {name} {new_name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Copy the theme.';

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

        if(file_exists($theme->dir_name)){
            $this->error("Error: New Theme {$this->argument('name')} already exists.");
            return Command::INVALID;
        }


        $status = File::copyDirectory(
            $theme->full_path,
            theme_path($this->argument('new_name'))
        );

        if(!$status){
            $this->error("Error: Theme faild.");
            return Command::INVALID;
        }

        // theme.json
        file_put_contents(
            theme_path("{$this->argument('new_name')}/theme.json"),
            str_replace('{{$name}}', "{$this->argument('new_name')}", file_get_contents(__DIR__. '/subs/theme.subs'))
        );

        $this->info("Theme copyied.".PHP_EOL);

        return Command::SUCCESS;
    }
}
