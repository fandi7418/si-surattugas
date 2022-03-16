<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SupervisorMiddleware
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
        if (\Auth::user()->roles_id == '6'){
            return $next($request);
          } else {
            return redirect()->back();
        }
    }
}
