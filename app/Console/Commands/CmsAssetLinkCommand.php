<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Support\Facades\File;

class CmsAssetLinkCommand extends StorageLinkCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cms:assets
                            {--relative : Create the symbolic link using relative paths}
                            {--force : Recreate existing symbolic links}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Themes and plugins assets symbolic links configured for the application';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        parent::handle();
    }


    /**
     * Get the symbolic links that are configured for the application.
     *
     * @return array
     */
    public function links()
    {
        $links = $this->base_links();
        if(is_dir(base_path('public'))){
            $links = $this->public_links();
        }
        return $links;
    }

    // links
    protected function base_links($links = [])
    {
        //Admin assets
        File::ensureDirectoryExists(base_path('themes/admin'));

        return [base_path('themes/admin/assets') => resource_path('assets')];
    }

    // or
    protected function public_links($links = [])
    {
        foreach (glob(theme_path('*/assets/')) as $path) {

            if( theme_path('admin/assets/') == $path){
                continue;
            }

            $theme_name = str_replace(theme_path(), '', $path);
            $theme_name = str_replace('/assets/', '', $theme_name);
            $theme_name = str_replace('/', '', $theme_name);

            //create directories
            $rel = 'public/themes/' . $theme_name;
            File::ensureDirectoryExists(base_path($rel));

            // append links
            $links[ base_path($rel .'/assets' )] = $path;
        }

        //Admin assets
        $path = base_path('public/themes/admin');
        File::ensureDirectoryExists($path);
        $links[ $path.'/assets' ]  = resource_path('assets');

        return $links;
    }

}
