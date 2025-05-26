<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function CreateUser()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('dashboard.create-user', compact('roles', 'permissions'));
    }

    public function ProcessCreateUser(Request $req)
    {
        $createUser = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required',
        ]);


        // dd($createUser);
        $user = User::create($createUser);

        // Get inserted ID
        $userId = $user->id;

        if ($req->has('permissions')) {
            foreach ($req->permissions as $permissionId) {
                UserPermission::create([
                    'user_id' => $userId,
                    'permission_id' => $permissionId,
                ]);
            }
        }



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
        $permissions = Permission::all();
        $user_permissions = UserPermission::where('user_id', $id)->get();
        $useraccess = $user_permissions->pluck('permission.id')->toArray();
        // dd($useraccess);
        // $useraccess = UserPermission::pluck('id')->toArray();

        // return $user;
        $roles = Role::all();

        // return $user;
        if ($id) {
            return view('dashboard.edit-user', compact('user', 'roles', 'permissions', 'useraccess'));
        }
        return back()->with('error', 'Account Not Found.');
    }

    public function ProcessEditUser(Request $req, string $id)
{
    // Fetch user by ID
    $updateUser = User::findOrFail($id);

    // Validate the form data
    $UserData = $req->validate([
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|email',
        'role_id' => 'required',
        'status' => 'required'
    ]);

    // Update the user's basic details
    $updateUser->update($UserData);

    // Get the permissions selected by the user from the request
    $permissions = $req->input('permissions', []);  // Default to empty array if no permissions selected

    // Sync permissions (this will add new permissions and remove unselected ones)
    $updateUser->permissions()->sync($permissions);

    // Return back with success message
    return back()->with('success', 'Account Updated Successfully.');
}

    public function Calender()
    {
        return view('dashboard.event-calender');
    }
}
