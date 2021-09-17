<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditpetugasController extends Controller
{
    public function index()
    {
        return view('admin.editpetugas', [
            "title" => "Edit Petugas Penomoran"
        ]); 
    }
}
