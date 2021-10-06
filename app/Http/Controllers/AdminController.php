<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboardadmin', [
            "title" => "Dashboard Admin"
        ]); 
    }

    public function index2()
    {
        return view('admin.editadmin', [
            "title" => "Edit Profil"
        ]); 
    }

    public function dataadmin()
    {
        
        $admin = DB::table('admin') -> get();
        return view('admin.dataadmin', ['admin' => $admin, "title" => "Data Admin"]);
    }

    public function editadmin($id)
    {
        $admin = DB::table('admin')->where('id', $id)->get();
        
        return view('admin.editadmin', ['admin' => $admin, "title" => "Edit Profil Admin"]);
    }
    
    public function updateadmin(Request $request)
    {
        DB::table('admin')->where('id', $request->id)->update([
            'nama_admin' => $request->nama,
            'NIP' => $request->NIP,
            'email_admin' => $request->email,
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_admin');
    }

    public function updatepassword(Request $request)
    {
        DB::table('admin')->where('id', $request->id)->update([
            'password' => Hash::make($request->password),
            
        ]);
        toast('Data Berhasil Diubah','success')->autoClose(5000);
        return redirect('/data_admin');
    }
    // public function resetadmin($id)
    // {
    //     $admin = DB::table('admin')->where('id', $id)->get();
        
    //     return view('admin.ubahpassword', ['admin' => $admin, "title" => "Ubah Password Admin"]);
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
