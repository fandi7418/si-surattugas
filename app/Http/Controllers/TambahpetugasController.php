<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahpetugasController extends Controller
{
    public function index()
    {
        return view('tambahpetugas', [
            "title" => "Tambah Petugas Penomoran"
        ]); 
    }
}
