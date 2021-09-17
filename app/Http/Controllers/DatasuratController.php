<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatasuratController extends Controller
{
    public function index()
    {
        return view('datasurat', [
            "title" => "Data Surat"
        ]); 
    }
}
