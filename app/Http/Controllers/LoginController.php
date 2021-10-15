<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');

    }

    public function postlogin(Request $request){

        if(Auth::guard('dosen')->attempt(['email_dosen' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboarddosen');
        } else if (Auth::guard('ketua_departemen')->attempt(['email_kadep' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboardkadep');
        } else if (Auth::guard('petugas_penomoran')->attempt(['email_petugas' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboardpetugas');
        } else if (Auth::guard('admin')->attempt(['email_admin' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard_admin');
        } else if (Auth::guard('wakildekan')->attempt(['email_wd' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboardwd');
        } else {
            // return back()->with('loginError', 'Login Gagal!');
            Alert::error('Login Gagal', 'Email atau Password Salah');
            return redirect('/');
        }
    }
    
    public function logout(){
        if (Auth::guard('dosen')->check())
        {
            Auth::guard('dosen')->logout();
        }
        else if (Auth::guard('ketua_departemen')->check())
        {
            Auth::guard('ketua_departemen')->logout();
        }
        else if (Auth::guard('petugas_penomoran')->check())
        {
            Auth::guard('petugas_penomoran')->logout();
        }
        else if (Auth::guard('admin')->check())
        {
            Auth::guard('admin')->logout();
        }
        else if (Auth::guard('wakildekan')->check())
        {
            Auth::guard('wakildekan')->logout();
        }
        return redirect('/');
        }

}
