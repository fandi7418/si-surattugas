<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        //$request = DB::table('users')->get();
        return view('login');

    }

    public function postlogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/dashboard_admin');
        }
        else{
            return back()->with('loginError', 'Login Gagal!');
        }
        // return redirect('/');
    }
    
    public function logout(){
        Auth::logout();
        return redirect ('/');
        }


    // public function authenticate(Request $request)
    // {
        
    //     $credentials = $request->validate([
    //         'email' => 'required|email:dns',
    //         'password' => 'required',
    //     ]);

    //     if(Auth::attempt($credentials)){
    //         $request->session()->regenerate();
    //         return redirect()->intended('/dashboarddosen');
    //     }
    // }
}
