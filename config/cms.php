<?php

return [

    /*
    |--------------------------------------------------------------------------
    | CMS installed
    |--------------------------------------------------------------------------
    |
    */
    'installed' => env('APP_INSTALLED', false),

    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    |
    |
    */
    'theme' => env('STANDARD_THEME', 'wokoya'),

    /*
    |--------------------------------------------------------------------------
    | Demo version
    |--------------------------------------------------------------------------
    |
    |
    */
    'demo' => env('APP_DEMO', FALSE),


    /*
    |--------------------------------------------------------------------------
    | Admin customizer
    |--------------------------------------------------------------------------
    |
    |
    */
    'admin_customizer' => env('ADMIN_CUSTOMIZER', false),
];
