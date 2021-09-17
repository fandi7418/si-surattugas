<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahdosenController extends Controller
{
    public function index()
    {
        return view('admin.tambahdosen', [
            "title" => "Tambah Dosen"
        ]); 
    }
}
