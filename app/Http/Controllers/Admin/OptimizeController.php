<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Artisan;
// use Illuminate\Support\Facades\Log;

class OptimizeController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function formInstaller(Request $request, Filesystem $file)
    {
        if($file->exists($path = storage_path('cms/installer.json'))){
            $file->delete($path);
        }
        // Artisan::call('optimize:clear');
        // Artisan::call('optimize');
        // Artisan::call('package:discover');
        // Artisan::call('config:clear');
        // Artisan::call('view:clear');

        // Log::info('Optimize cms');

        return redirect()->route('login', ['ref' => 'installer']);
    }

}
