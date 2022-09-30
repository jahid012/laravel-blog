<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Installer\AdminController;
use App\Http\Controllers\Installer\InitController;
use App\Http\Controllers\Installer\InstallController;

Route::prefix('installer')->group(function () {

    /*--------------------------------------------------------
    | Init
    ---------------------------------------------------------*/
    Route::get("/", [InitController::class, "index"] )->name('install.index');
    Route::get("/store", [InitController::class, "store"])->name('install.set_asset_url');
    Route::any('/welcome', [InitController::class, "welcome"])->name('install.welcome');

    /*--------------------------------------------------------
    | Webcome
    ---------------------------------------------------------*/
    Route::get("/check_env", [InstallController::class, "check_env"])->name('install.check_env');
    Route::any("/init", [InstallController::class, "init"])->name('install.init');

    /*--------------------------------------------------------
    | Check Server permissions
    ---------------------------------------------------------*/

    Route::get("permissions", [InstallController::class, "permissions"])
        ->name('install.permissions');

    Route::get("requirements", [InstallController::class, 'requirements'])
        ->name('install.requirements');

    /*---------------------------------------------------------------------------------
    | Database
    ---------------------------------------------------------------------------------*/
    Route::get("database", [InstallController::class, 'databaseInfoForm'])
        ->name('install.databaseInfoForm');

    Route::post("database", [InstallController::class, 'databaseInfo'])
        ->name('install.databaseInfo');

    Route::get("installation", [InstallController::class, "installationShowForm"])
        ->name('install.installationShowForm');

    Route::post("installation", [InstallController::class, "installation"])
        ->name('install.installation');

    /*---------------------------------------------------------------------------------
    | Admin user
    ---------------------------------------------------------------------------------*/
    Route::get("admin", [AdminController::class, 'create'])->name('install.admin');
    Route::post("admin", [AdminController::class, 'store'])->name('install.admin_store');

    /*--------------------------------------------------------
    | finals
    ---------------------------------------------------------*/
    Route::match(['get', 'post'], "final", [InstallController::class, 'finish'])
        ->name('install.final');

    Route::get("error", [InstallController::class, 'fails'])
        ->name('install.fails');

});
