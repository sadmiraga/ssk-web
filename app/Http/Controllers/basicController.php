<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class basicController extends Controller
{
    public function odjava()
    {
        Auth::logout();
        return redirect('/');
    }
}
