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
}
