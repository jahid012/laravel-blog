<?php

namespace App\Http\Middleware;

use Closure;

class MakeStorageLinkMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $ptah = base_path('uploads');
        view()->share( 'storageIs', !file_exists( $ptah ) );
        return $next($request);
    }
}
