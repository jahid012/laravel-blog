<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Theme extends Facade
{
    /**
     * @see \App\Support\Theme
     */
    protected static function getFacadeAccessor(): string
    {
        return 'theme';
    }
}
