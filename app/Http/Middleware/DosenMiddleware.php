<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class DosenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $roles = 'dosen';

        foreach ($roles as $role) { 
            $user = \Auth::user()->role;
            if( $user == $role){
                return $next($request);
            }
        }

    //     if ($guard == 'dosen') {
    //         if (Auth::guard($guard)->check()) {
    //                return redirect('/dashboarddosen');
    //         }
    //    }
        return redirect('/');
    }
}
