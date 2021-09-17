<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardadminController extends Controller
{
    public function index()
    {
        return view('dashboardadmin', [
            "title" => "Dashboard Admin"
        ]); 
    }
}
