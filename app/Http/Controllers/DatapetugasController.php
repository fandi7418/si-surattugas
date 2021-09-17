<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatapetugasController extends Controller
{
    public function index()
    {
        return view('admin.datapetugas', [
            "title" => "Data Petugas Penomoran"
        ]); 
    }
}
