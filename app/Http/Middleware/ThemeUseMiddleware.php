<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ThemeUseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!app('themes')->current()['shortname']){
            return response()->view('welcome');
        }
        return $next($request);
    }
}
