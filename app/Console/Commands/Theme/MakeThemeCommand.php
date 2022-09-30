<?php

namespace App\Console\Commands\Theme;

use Illuminate\Console\Command;
use App\Facades\Theme;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Config;

class MakeThemeCommand extends Command
{
    protected $file;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'theme:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new theme';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $file)
    {
        parent::__construct();
        $this->file = $file;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        if (!Theme::exists($name) && is_dir(theme_path($name))) {
            $this->error("Error: Theme $name already exists");
            return Command::INVALID;
        }

        // create dir
        $this->file->ensureDirectoryExists(theme_path("{$name}/assets/css"));
        $this->file->ensureDirectoryExists(theme_path("{$name}/assets/js"));
        $this->file->ensureDirectoryExists(theme_path("{$name}/views/pages/home"));
        $this->file->ensureDirectoryExists(theme_path("{$name}/views/partials"));
        $this->file->ensureDirectoryExists(theme_path("{$name}/views/layouts"));
        $this->file->ensureDirectoryExists(theme_path("{$name}/functions"));
        $this->file->ensureDirectoryExists(theme_path("{$name}/lang/en"));
        $this->file->ensureDirectoryExists(theme_path("{$name}/lang/".Config::get('app.faker_locale')));
        $this->file->ensureDirectoryExists(theme_path("{$name}/lang/".app()->getLocale()));

        // theme.json
        file_put_contents(
            theme_path("{$name}/theme.json"),
            str_replace('{{$name}}', "{$name}", file_get_contents(__DIR__. '/subs/theme.subs'))
        );

        // README.md
        file_put_contents(
            theme_path("{$name}/README.md"),
            str_replace('{{$name}}', "{$name}", file_get_contents(__DIR__. '/subs/readme.stub'))
        );

        // options
        file_put_contents(
            theme_path("{$name}/functions/theme-options.php"),
            file_get_contents(__DIR__. '/subs/theme-options.stub')
        );
        file_put_contents(
            theme_path("{$name}/views/options.blade.php"),
            file_get_contents(__DIR__. '/subs/theme-options-view.stub')
        );

        $this->info('Theme Create complete!');
        return Command::SUCCESS;
    }
}
