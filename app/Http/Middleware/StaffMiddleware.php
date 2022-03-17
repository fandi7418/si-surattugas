<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class StaffMiddleware
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
        if (\Auth::user()->roles_id == '4' || \Auth::user()->roles_id == '5' || \Auth::user()->roles_id == '6' || \Auth::user()->roles_id == '7'){
            return $next($request);
          } else {
            return redirect()->back();
        }
    }
}
