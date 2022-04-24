<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class SubscribersController extends Controller
{
    public function index()
    {

        $subscribers = Email::distinct('email')->pluck('email');
        return view('admin.subscribers.index', compact('subscribers'));
    }
}
