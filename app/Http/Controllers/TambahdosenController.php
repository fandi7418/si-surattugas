<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahdosenController extends Controller
{
    public function index()
    {
        return view('tambahdosen', [
            "title" => "Tambah Dosen"
        ]); 
    }
}
