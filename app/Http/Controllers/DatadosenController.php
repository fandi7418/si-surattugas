<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatadosenController extends Controller
{
    public function index()
    {
        return view('datadosen', [
            "title" => "Data Dosen"
        ]); 
    }
}
