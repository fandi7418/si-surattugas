<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatakadepController extends Controller
{
    public function index()
    {
        return view('datakadep', [
            "title" => "Data Ketua Departemen"
        ]); 
    }
}
