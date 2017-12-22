<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class LoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {


        if(Auth::check() || Auth::guard('teamforge')->check()){

            return $next($request);
        }

        return redirect('/login');

    }
}
