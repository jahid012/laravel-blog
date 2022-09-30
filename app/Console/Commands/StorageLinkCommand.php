<?php

namespace App\Console\Commands;

use Illuminate\Foundation\Console\StorageLinkCommand as ConsoleStorageLinkCommand;
use Illuminate\Support\Facades\File;

class StorageLinkCommand extends ConsoleStorageLinkCommand
{
    /**
     * Get the symbolic links that are configured for the application.
     *
     * @return array
     */
    public function links()
    {
        File::ensureDirectoryExists(storage_path('app/public'));
        
        $path = [base_path('uploads') => storage_path('app/public')];

        if(is_dir(base_path('public'))){
            $path = [public_path('uploads') => storage_path('app/public')];
        }

        //delete upload base links
        if(is_dir(base_path('public')) && is_dir(base_path('uploads'))){
            File::delete(base_path('uploads'));
        }

        return $path;
    }

}
