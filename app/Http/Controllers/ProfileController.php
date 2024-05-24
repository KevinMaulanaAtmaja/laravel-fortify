<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function editProfile()
    {
        return view('profile.editProfile');
    }

    public function changePassword()
    {
        return view('profile.changePassword');
    }
}
