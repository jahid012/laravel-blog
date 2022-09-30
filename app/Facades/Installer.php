<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\Support\Installer as Support;

/**
 *
 * @see \App\Support\Installer
 */
class Installer extends Facade
{
	protected static function getFacadeAccessor(): string
	{
		return Support::class;
	}
}
