<?php

namespace App\Facades;

use App\Support\Env as EnvFacade;
use Illuminate\Support\Facades\Facade;

class Env extends Facade
{
    /**
     * @see \App\Support\Env
     */
    protected static function getFacadeAccessor(): string
    {
        return EnvFacade::class;
    }
}
