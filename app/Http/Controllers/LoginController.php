<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
// use \Illuminate\Session\Middleware\AuthenticateSession;

class LoginController extends Controller
{
    public function index()
    {
        if(Auth::guard('pengguna')->check()){
            return redirect()->back();
        } else {
            return view('login');
        }

    }

    public function postlogin(Request $request){

        if(Auth::guard('pengguna')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::guard('pengguna')->user()->roles_id == '1'){
                return redirect('/dashboarddosen');
            } else if (Auth::guard('pengguna')->user()->roles_id == '2'){
                return redirect('/dashboardkadep');
            } else if (Auth::guard('pengguna')->user()->roles_id == '3'){
                return redirect('/dashboardwd');
            } else if (Auth::guard('pengguna')->user()->roles_id == '4'){
                return redirect('/dashboardStaff');
            } else if (Auth::guard('pengguna')->user()->roles_id == '5'){
                return redirect('/dashboardStaff');
            } else if (Auth::guard('pengguna')->user()->roles_id == '6'){
                return redirect('/dashboardSpv');
            } else if (Auth::guard('pengguna')->user()->roles_id == '7'){
                return redirect('/dashboardpetugas');
            } else if (Auth::guard('pengguna')->user()->roles_id == '8'){
                return redirect('/dashboard_admin');
            }
        } else {
            // return back()->with('loginError', 'Login Gagal!');
            Alert::error('Login Gagal', 'Email atau Password Salah');
            return redirect('/');
        }
    }
    
    public function logout(){
        if (Auth::guard('pengguna')->check())
        {
            Auth::guard('pengguna')->logout();
        }
        return redirect('/');
        }

    // protected function authenticated()
    // {
    //     \Auth::logoutOtherDevices(request('password'));
    // }

}
