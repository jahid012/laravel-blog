<?php

namespace App\Facades;

use App\Support\Media as MediaFacade;
use Illuminate\Support\Facades\Facade;

class Media extends Facade
{

    /**
     * @see \App\Support\Media
     */
    protected static function getFacadeAccessor(): string
    {
        return MediaFacade::class;
    }
}
