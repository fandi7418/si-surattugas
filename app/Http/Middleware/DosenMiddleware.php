<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class DosenMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (\Auth::user()->roles_id == '1' || '2' || '3'){
            return $next($request);
          } else {
            return redirect()->back();
        }

        // $roles = 'dosen';

        // foreach ($roles as $role) { 
        //     $user = \Auth::user()->role;
        //     if( $user == $role){
        //         return $next($request);
        //     }
        // }
        // return redirect('/');
    }
}
