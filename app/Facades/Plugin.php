<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Plugin extends Facade
{
    /**
     * @see \App\Support\Plugin
     */
    protected static function getFacadeAccessor(): string
    {
        return 'plugin';
    }
}
