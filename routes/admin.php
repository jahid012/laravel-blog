<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Authorization\RoleController;
use App\Http\Controllers\Authorization\PermissionController;

use App\Http\Controllers\Admin\ActivityController;
use App\Http\Controllers\Admin\CustomizerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\User\ProfileController;
use App\Http\Controllers\Admin\User\UserActivityController;
use App\Http\Controllers\Admin\User\UserSessionController;

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\OptimizeController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PluginController;
use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\Admin\ThemeLanguageController;
use App\Http\Middleware\DemoMiddleware;

//dashbaord
Route::get('/', function () {
    return redirect()->route('dashboard');
});

/*
|--------------------------------------------------------------------------
| Optimize
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->group(function (){
    /*
    |--------------------------------------------------------------------------
    | After login Optimize
    |--------------------------------------------------------------------------
    */
    Route::get('optimize/formInstaller', [OptimizeController::class, 'formInstaller'])->name('optimize.formInstaller');

});

Route::prefix('admin')->middleware(['auth', 'verified'])->group(function (){

    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('permission:dashboard.viewAny');

    /*
    |--------------------------------------------------------------------------
    | Create storage link
    |--------------------------------------------------------------------------
    */
    Route::post('storage/link_create', [StorageController::class, 'link_create'])->name('storage.link_create');

    /*
    |--------------------------------------------------------------------------
    | Pages
    |--------------------------------------------------------------------------
    */
    Route::resource('pages', PageController::class)->except('show');

    /*
    |--------------------------------------------------------------------------
    | Users manage
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);
    Route::post('users/{id}/change_password', [UserController::class, 'change_password'])->name('users.change_password');

    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */
    Route::get('profile', [ProfileController::class, 'show'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('profile/change_password', [ProfileController::class, 'change_password'])->name('profile.change_password');

    Route::get('profile/activities', [UserActivityController::class, 'show'])->name('profile.activity');
    Route::delete('profile/activities/{id}', [UserActivityController::class, 'destroy'])->name('profile.activity.destroy');

    Route::get('profile/sessions', [UserSessionController::class, 'show'])->name('profile.session');
    Route::delete('profile/sessions/{id}', [UserSessionController::class, 'destroy'])->name('profile.session.destroy');

    /*
    |--------------------------------------------------------------------------
    | Roles & Permissions
    |--------------------------------------------------------------------------
    */
    Route::resource('roles', RoleController::class);
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('permissions', [PermissionController::class, 'update'])->name('permissions.update');
    Route::post('permissions/{role_id}', [PermissionController::class, 'updateByRoleName'])->name('permissions.updateByRoleName');

    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('settings.update');
    Route::get('settings/general', [SettingController::class, 'general'])->name('settings.general');
    Route::get('settings/auth', [SettingController::class, 'auth'])->name('settings.auth');
    Route::get('settings/notifications', [SettingController::class, 'notifications'])->name('settings.notifications');
    Route::get('settings/mail', [SettingController::class, 'mail'])->name('settings.mail');
    Route::post('settings/mail', [SettingController::class, 'update_mail'])->name('settings.update_mail');

    /*
    |--------------------------------------------------------------------------
    | Activities
    |--------------------------------------------------------------------------
    */
    Route::get('activities', [ActivityController::class, 'index'])->name('activity.index');

    /*
    |--------------------------------------------------------------------------
    | Theme, mnus , Translate
    |--------------------------------------------------------------------------
    */
    Route::prefix('themes')->group(function (){

        Route::get('/', [
            'as' => "themes.index",
            'uses' => 'App\\Http\\Controllers\\Admin\\ThemeController@index',
            'permission' => 'theme.viewAll'
        ]);

        Route::post('active', [
            'as' => "themes.active",
            'uses' => 'App\\Http\\Controllers\\Admin\\ThemeController@active',
            'permission' => 'theme.active'
        ]);

        // theme options
        Route::get('options', [
            'as' => "themes.options",
            'uses' => 'App\\Http\\Controllers\\Admin\\ThemeController@options',
            'permission' => 'theme.options'
        ]);

        Route::post('options', [
            'as' => "themes.update_options",
            'uses' => 'App\\Http\\Controllers\\Admin\\ThemeController@update_options',
            'permission' => 'theme.update_options'
        ]);

        // languages
        Route::resource('languages', ThemeLanguageController::class, ['as' => 'themes'])->except(['edit', 'update', 'show']);

        Route::get('translate', [
            'as' => "themes.translate",
            'uses' => 'App\\Http\\Controllers\\Admin\\ThemeController@translate',
            'permission' => 'theme.languages'
        ]);

        Route::post('translate', [
            'as' => "themes.languages_update",
            'uses' => 'App\\Http\\Controllers\\Admin\\ThemeController@languages_update',
            'permission' => 'theme.languages'
        ]);
    });

    /*
    |--------------------------------------------------------------------------
    | Plugin
    |--------------------------------------------------------------------------
    */
    Route::prefix('plugins')->group(function (){
        Route::get('/', [PluginController::class, 'index'])->name('plugins.index');
        Route::get('options', [PluginController::class, 'options'])->name('plugins.options');
    });

    /*
    |--------------------------------------------------------------------------
    | Menus
    |--------------------------------------------------------------------------
    */
    Route::resource('menus', MenuController::class)->names([
        'show' => 'menus.builder'
    ]);

    // menu item
    Route::post('menus/{menu}/add-item', [MenuController::class, 'addItem'])->name('menus.additem');
    Route::post('menus/{menu}/order-item', [MenuController::class, 'orderItem'])->name('menus.orderitem');
    Route::post('menu-item/{menuItem}/update', [MenuController::class, 'updateItem'])->name('menus.updateitem');
    Route::delete('menu-item/{menuItem}/destroy', [MenuController::class, 'destroyItem'])->name('menus.destroyitem');

    /*
    |--------------------------------------------------------------------------
    | Media
    |--------------------------------------------------------------------------
    */
    Route::prefix('media')->group(function ()
    {
        Route::get('/', [MediaController::class, 'index'])->name('media.index');
        Route::post('/', [MediaController::class, 'store'])->name('media.store');
        Route::delete('{year}/{month?}/{filename?}', [MediaController::class, 'destroy'])->name('media.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    */


    /*
    |--------------------------------------------------------------------------
    | Icon
    |--------------------------------------------------------------------------
    */
    Route::match(['get', 'post'], 'customizers', [CustomizerController::class, 'index'])->name('customizers.quick')->withoutMiddleware(DemoMiddleware::class);

});
