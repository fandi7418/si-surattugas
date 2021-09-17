<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditkadepController extends Controller
{
    public function index()
    {
        return view('admin.editkadep', [
            "title" => "Edit Ketua Departemen"
        ]); 
    }
}
