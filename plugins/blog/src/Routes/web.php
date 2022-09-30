<?php

// use App\Http\Controllers\Admin\Blog\PostController;
use Illuminate\Support\Facades\Route;
use Plugins\Blog\Http\Controllers\Admin\CategoryController;
use Plugins\Blog\Http\Controllers\Admin\PostController;

/*
|--------------------------------------------------------------------------
| faq Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin/blog')->group(function (){
    Route::get('/', function (){
        return redirect()->route('posts.index');
    });
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostController::class);
});

