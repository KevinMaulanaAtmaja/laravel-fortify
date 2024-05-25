<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function dashboard()
    {
        return view('home');
    }
    public function twoFactorSettings()
    {
        return view('auth.two-factor-settings');
    }
}
