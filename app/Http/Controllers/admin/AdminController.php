<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function CreateUser()
    {
        $roles = Role::all();
        return view('dashboard.create-user', compact('roles'));
    }

    public function ProcessCreateUser(Request $req)
    {
        $createUser = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required'
        ]);

        User::create($createUser);
        return back()->with('success', 'Account created successfully.');
    }

    public function ViewUsers()
    {
        $allusers = User::with('role')->get();
        return view('dashboard.view-users', compact('allusers'));
    }

    public function DeleteUser(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return back()->with('success', 'Account delete successfully.');
    }

    public function EditUser(string $id)
    {
        $user = User::with('role')->findOrFail($id);
        $roles = Role::all();

        // return $user;
        if ($id) {
            return view('dashboard.edit-user', compact('user', 'roles'));
        }
        return back()->with('error', 'Account Not Found.');
    }

    public function ProcessEditUser(Request $req, string $id)
    {
        $updateUser = User::findOrFail($id);

        $UserData = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'role_id' => 'required',
            'status' => 'required'
        ]);

        $updateUser->update($UserData);

        if ($updateUser) {
            return back()->with('success', 'Account Updated Successfully.');
        }
    }

    public function Calender()
    {
        return view('dashboard.event-calender');
    }
}
