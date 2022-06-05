<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        $users =  DB::table('users')->join('user_types', function ($join) {
            $join->on('user_types.id', '=', 'users.type_id');
        })->select('users.id as id', 'users.firstName as firstName', 'users.lastName as lastName', 'users.email as email', 'users.hour_rate as hour_rate', 'user_types.userType as userType')->get();

        dd($users);

        return view('admin.users')->with('users', $users);
    }
}
