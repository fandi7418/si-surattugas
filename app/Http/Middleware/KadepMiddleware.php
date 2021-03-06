<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class KadepMiddleware
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
        if (\Auth::user()->roles_id == '2'){
            return $next($request);
          } else {
            return redirect()->back();
        }
    }
}
