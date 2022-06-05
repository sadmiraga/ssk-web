<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\UserType;

class UsersController extends Controller
{
    public function index()
    {
        $users =  DB::table('users')->join('user_types', function ($join) {
            $join->on('user_types.id', '=', 'users.type_id');
        })->select('users.id as id', 'users.firstName as firstName', 'users.lastName as lastName', 'users.email as email', 'users.hour_rate as hour_rate', 'user_types.userType as userType')->get();

        return view('admin.users.index')->with('users', $users);
    }

    public function edit($user_id)
    {
        $user = User::find($user_id);
        $userTypes = UserType::all();

        return view('admin.users.edit', compact('user', 'userTypes'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->input('userID'));
        $user->type_id = $request->input('type_id');
        $user->hour_rate = $request->input('hour_rate');
        $user->save();

        return redirect()->route('employees.index');
    }
}
