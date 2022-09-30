<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CmsUsePublicDirCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:mirror';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use Public directory is document root or not';

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
        if (is_dir(dirname(__DIR__, 3) .'/public' )) {

            $this->makeBaseDirBase();
            $this->info('This application now use base directory as document root!');
        }else{

            $this->makePublicDirBase();
            $this->info('This application now use public directory as document root!');
        }

        $this->call('cms:asset');

        if(file_exists(base_path('0'))){
            File::delete(base_path('0'));
        }

        return Command::SUCCESS;
    }

    /**
     *
     */
    public function makeBaseDirBase(): void
    {
        File::deleteDirectories(base_path('public'));
        File::deleteDirectory(base_path('public'));

        $this->copyOrReplaceFile([
            base_path('server.php')  => app_path('Console/Commands/stubs/use/base/server.stub'),
            base_path('index.php')   => app_path('Console/Commands/stubs/use/base/index.stub'),
            base_path('.htaccess')   => app_path('Console/Commands/stubs/use/base/htaccess.stub'),
        ]);
    }

        /**
     *
     */
    public function makePublicDirBase()
    {
        if(!is_dir(base_path('public'))){
            File::makeDirectory(base_path('public'));
        }

        // delete file unuse files
        if(file_exists(base_path('index.php'))){
            File::delete(base_path('index.php'));
        }

        if(file_exists(base_path('.htaccess'))){
            File::delete(base_path('.htaccess'));
        }

        $data = array(
            base_path('public/index.php') => app_path('Console/Commands/stubs/use/public/index.stub'),
            base_path('public/.htaccess') => app_path('Console/Commands/stubs/use/public/htaccess.stub'),
            base_path('public/robots.txt') => app_path('Console/Commands/stubs/use/public/robots.stub'),
            base_path('public/web.config') => app_path('Console/Commands/stubs/use/public/web.config.stub'),
            base_path('server.php')        => app_path('Console/Commands/stubs/use/public/server.stub'),
        );

        $this->copyOrReplaceFile($data);
    }

    /**
     *  Get Content and put content
     * @return void
     */
    public function copyOrReplaceFile($data): void
    {
        foreach ($data as $target => $source) {
            file_put_contents($target,
                file_get_contents($source)
            );
        }
    }


}
