<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class IsDatabaseSession
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
        if (env('APP_INSTALLED') && env('SESSION_DRIVER') != 'database') {
            return throw new NotFoundHttpException('Session drive is not database. Update .env file');
        }
        return $next($request);
    }
}
