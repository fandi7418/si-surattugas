<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TambahkadepController extends Controller
{
    public function index()
    {
        return view('admin.tambahkadep', [
            "title" => "Tambah Ketua Departemen"
        ]); 
    }
}
