<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ThemeOption extends Facade
{
    /**
     * @see \App\Models\ThemeOption
     */
    protected static function getFacadeAccessor(): string
    {
        return 'themeOption';
    }
}
