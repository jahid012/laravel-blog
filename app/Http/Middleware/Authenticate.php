<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        if(Auth::user()->status == 'ben'){
            return new Response(view('auth.benuser'));
        }

        $this->updateLastActivity(Session::getId());

        return $next($request);
    }

    /**
     * Update Last activity
     * @param int $sessionId
     * @return void
     */
    public function updateLastActivity($sessionId )
    {
        if(Auth::user()->last_activity != $sessionId && config('session.driver') == 'database'){

            $session = DB::table('sessions')->where('id', $sessionId)->first();

            Auth::user()->forceFill([
                'last_activity' => $session->last_activity
            ])->save();
        }
    }

}

