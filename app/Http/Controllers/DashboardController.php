<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        return view('content.index');
        return view('dashboard');
    }
}
