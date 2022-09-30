<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server Requirements
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel server requirements, you can add as many
    | as your application require, we check if the extension is enabled
    | by looping through the array and run "extension_loaded" on it.
    |
    */
    'core' => [
        'minPhpVersion' => '8.0.0',
    ],
    'final' => [
        'key' => true,
        'publish' => false,
    ],
    'requirements' => [
        'php' => [
            'openssl',
            'mbstring',
            'tokenizer',
            'JSON',
            'cURL',
            'bcmath',
            'PDO',
            'pdo_mysql',
            'pdo_sqlite',
            'mbstring',
            'tokenizer',
            'xml',
            'ctype',
            'json',
            'gd',
            'fileinfo',
          //  'xdebug'
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Folders Permissions
    |--------------------------------------------------------------------------
    |
    | This is the default Laravel folders permissions, if your application
    | requires more permissions just add them to the array list bellow.
    |
    */
    'permissions' => [
        'storage/app/'              => 777,
        'storage/framework/'        => 777,
        'storage/logs/'             => 777,
        'bootstrap/cache/'          => 777,
        'database/database.sqlite'  => 777,
        'themes/'                   => 777,
        'resources/lang/'           => 777,
        '.env'                      => 777,
    ],
];
