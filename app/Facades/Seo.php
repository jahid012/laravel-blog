<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Support\Seo as SeoFacade;

class Seo extends Facade
{
    protected static function getFacadeAccessor()
    {
        return SeoFacade::class;
    }
}
