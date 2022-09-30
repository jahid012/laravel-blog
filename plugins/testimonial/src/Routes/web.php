<?php

use Illuminate\Support\Facades\Route;
use Plugins\Testimonial\Http\Controllers\TestimonialController;

/*
|--------------------------------------------------------------------------
| Testimonial Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->name('admin.')->group(function (){
    Route::resource('testimonials', TestimonialController::class);
});

// Route::resource('facts', FaqController::class)->only('store');
