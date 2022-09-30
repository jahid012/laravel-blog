<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Some time installer not working for memory limit
 * you can use this route for demo installation
 *
 * 1. set APP_URL
 * 2. set APP_ASSET
 * 3. go to yourdomain.com/demo-install
 *
 * demo admin user
 * email: admin@admin.com
 * password: password
 */

Route::get('/demo-install', function ()
{
    if(env('APP_INSTALLED') != true){
        Artisan::call('demo:install');
    }else{
        abort(404);
    }
});

require __DIR__.'/installer.php';
require __DIR__.'/auth.php';
require __DIR__.'/admin.php';

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('blog', [PageController::class, 'blog'])->name('blog');
Route::get('blog/{slug}', [PageController::class, 'post'])->name('post');
// custom page
Route::get('/{slug}', [PageController::class, 'any'])->name('page')->where('slug', '.*');
