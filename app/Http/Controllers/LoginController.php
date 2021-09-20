<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index()
    {
        //$request = DB::table('users')->get();
        return view('login');
    }

    public function authenticate(Request $request)
    {
        
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if(Auth::attempt()){
            $request->session()->regenerate();
            return redirect()->intended('/dashboarddosen');
        }
        else{
            return back()->with('loginError', 'Login Gagal!');
        }
    }
}
