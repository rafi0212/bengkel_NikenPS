<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function superadmin()
    {
        return view('superadmin.dashboard');
    }

    public function kasir()
    {
        return view('kasir.dashboard');
    }
}
