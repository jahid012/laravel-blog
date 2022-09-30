<?php

use Illuminate\Support\Facades\Route;
use Plugins\Contact\Http\Controllers\ContactController;

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

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function (){
    Route::resource('contacts', ContactController::class);
    Route::post('contacts/{contact}/replay', [ContactController::class, 'replay'])->name('contacts.replay');
});

Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');
