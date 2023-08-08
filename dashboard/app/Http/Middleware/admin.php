<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class admin
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
        if (Auth::user() &&  (Auth::user()->rol == 'admin' || Auth::user()->rol == 'secretary' || Auth::user()->rol == 'labor' || Auth::user()->rol == 'report')){
            return $next($request);
       }

       return redirect('login')->with('error','You have not admin access');

    }
}
