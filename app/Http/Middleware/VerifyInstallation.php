<?php

namespace App\Http\Middleware;

use App\Facades\Env;
use Closure;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class VerifyInstallation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */
    public function handle($request, Closure $next)
    {
        if(env('APP_INSTALLED') == null || env('APP_INSTALLED') == false){
            redirect('/');
        }

        if (!env('APP_INSTALLED') && ! $request->is('install*') && Route::has('install.permissions') ) {
            Env::update([
                'APP_ENV'           => 'local',
                'APP_DEBUG'         => 'true',
                "SESSION_DRIVER"    => "file",
                'APP_DEMO'          => 'false',
                'ASSET_URL'         => 'null',
            ]);
            sleep(1);
            return redirect(route('install.index', [], false));
        }

        if (env('APP_INSTALLED') && $request->is('install*') && ! $request->is('install/final')) {
            throw new NotFoundHttpException;
        }

        return $next($request);
    }
}
