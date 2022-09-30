<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Artisan;

class StorageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function link_create()
    {
        if( file_exists( public_path('uploads') )){
            return \back()->with(['message' => "Storage link file already exists", 'alert-type' => 'error']);
        }

        Artisan::call('storage:link');

        return \back()->with(['message' => "Success to create storage link", 'alert-type' => 'success']);
    }

}
