<?php

namespace App\Console\Commands\Theme;

use Illuminate\Console\Command;
use App\Facades\Theme;

class ThemeListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List available themes.';

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
        $list = [];
        foreach (Theme::all() as $th ) {
            $list [] = array(
                $th->enable? '*': ' ',
                $th->name,
                $th->version,
                $th->dir_name,
                $th->author_name,
            );
        }

        $this->table(
            ['active', 'Name', 'Version', 'Dir', 'vendor'],
            $list
        );
        $this->info(PHP_EOL."[*] Active  [ ] Installed");

        return Command::SUCCESS;
    }
}
