<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditdosenController extends Controller
{
    public function index()
    {
        return view('editdosen', [
            "title" => "Edit Dosen"
        ]); 
    }
}
