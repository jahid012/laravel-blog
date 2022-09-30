<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DemoMiddleware
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
        if ( !$request->is('lo*') && !$request->isMethod('get') && config('cms.demo') ) {

            if($request->ajax()){
                return response()->json(['message' => "Demo Version. You can not do it.", 'alert-type'=> 'error'], 200);
            }
            return back()->with('message', "Demo Version. You can not do it.");
        }
        return $next($request);
    }
}
