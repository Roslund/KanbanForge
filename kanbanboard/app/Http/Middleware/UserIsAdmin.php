<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserIsAdmin
{
    public function get_guard(){
        if(Auth::guard('admin')->check())
            {return "admin";}
        elseif(Auth::guard('teamforge')->check())
            {return "teamforge";}
        elseif(Auth::check())
            {return "web";}
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard == NULL){
            $guard = $this->get_guard();
         }

         // To be deleted once the admin table is gone
        if($guard == 'admin'){
            return $next($request);
        }

        $user = Auth::guard($guard)->user();
        if($user == NULL || $user->isadmin() == false){
            return redirect('/login');
        }
        return $next($request);
        
    }
}
