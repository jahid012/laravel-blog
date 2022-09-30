<?php

namespace App\Console\Commands\Plugin;

use Illuminate\Console\Command;
use App\Facades\Plugin;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

class MakePluginCommand extends Command
{
    protected $file;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'plugin:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Plugin';

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

        if( Str::singular($name) != $name){
            $this->error("Error: Plugin name is not singular");
            return Command::INVALID;
        }
        if( strtolower($name) != $name){
            $this->error("Error: Plugin name is not strtolower");
            return Command::INVALID;
        }

        if (Plugin::exists($name)) {
            $this->error("Error: Plugin $name already exists");
            return Command::INVALID;
        }

        // create dir
        $this->ensureDirectories(
            array(
                "assets/css",
                "assets/js",
                "assets/img",
                "resources/views/partials",
                "resources/views/admin",
                "resources/views/layouts",
                "resources/lang/" . app()->getLocale(),
                "src/Http/Controllers/Admin",
                "src/Models",
                "src/Http/Middleware",
                "src/Http/Requests",
                "src/Providers",
                "src/Routes",
                "database/migrations",
                "database/seeders",
                "database/factories",
            )
        );

        $this->parserStubs($this->getFiles());

        $this->info('Plugin Create complete!');
        return Command::SUCCESS;
    }

    public function ensureDirectories($dirs)
    {
        $name = $this->argument('name');

        foreach ($dirs as $dir) {
            $this->file->ensureDirectoryExists(plugin_path("{$name}/{$dir}"));
            $this->file->put(plugin_path("{$name}/{$dir}/.gitkeep"), '');
        }

        return true;
    }

    public function parserStubs($data)
    {
        $name = $this->argument('name');

        foreach ($data as $source => $target) {
            $content = str_replace('{{$name}}', $name, file_get_contents(__DIR__ . "/{$source}"));
            $content = str_replace('{{$ucname}}', ucfirst($name), $content);

            file_put_contents(
                plugin_path("{$name}/$target"),
                $content
            );
        }
    }

    public function getFiles()
    {
        $name = $this->argument('name');
        $ucname = ucfirst($name);
        return [
            'subs/conposer.stub' => 'composer.json',
            'subs/readme.stub' => 'README.md',
            'subs/route.stub' => 'src/Routes/web.php',
            'subs/model.stub' => "src/Models/{$ucname}.php",
            'subs/http/controller/controller.stub' => "src/Http/Controllers/{$ucname}Controller.php",
            'subs/http/controller/admin/controller.stub' => "src/Http/Controllers/Admin/{$ucname}Controller.php",
            'subs/seeder.stub' => 'src/Database/Seeders/DatabaseSeeder.php',
            'subs/providers/serviceProvider.stub' => "src/Providers/{$ucname}ServiceProvider.php",
            'subs/providers/routeServiceProvider.stub' => 'src/Providers/RouteServiceProvider.php',

        ];
    }
}
