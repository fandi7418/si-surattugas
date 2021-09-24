<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditadminController extends Controller
{
    public function index()
    {
        return view('admin.editadmin', [
            "title" => "Edit Admin"
        ]); 
    }
    public function edit(request $request)
    {
        return view('admin.editadmin',[
            'admin' => $request->admin()
        ]);
    }
}
