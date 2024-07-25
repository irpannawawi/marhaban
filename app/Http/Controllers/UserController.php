<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact(['users']));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|string',
        ]);
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('administrator.index');
    }

    public function edit($id)
    {
        $user = User::findorfail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role' => 'required|string',
        ]);
        $user = User::findorfail($id);
        if ($request->has('password')) {
            if ($request->password != $request->password) {
                $user->password = Hash::make($request->password);
            }
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        $user->save();
        return redirect()->route('administrator.index');
    }

    public function destroy($id)
    {
        User::findorfail($id)->delete();
        return redirect()->back();
    }
}
