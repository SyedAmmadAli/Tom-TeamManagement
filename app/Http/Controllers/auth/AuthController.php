<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function ProcessLogin(Request $req)
    {

        $userData = $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($userData)) {
            // dd(Auth::user());
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentials');
        }
    }

    public function Index()
    {

        $loggedUserid = Auth::Id();
        // return (Auth::user());
        $usersCount = User::count();
        $agentsCount = User::where('role_id', 2)->count();
        $backOfficeCount = User::where('role_id', 3)->count();
        $AccountingCount = User::where('role_id', 3)->count();
        $teamLeadCount = User::where('role_id', 7)->count();
        $Pendingtasks = Task::whereIn('status', ['in_progress', 'open'])
            ->whereHas('assignedusers', function ($query) use ($loggedUserid) {
                $query->where('user_id', $loggedUserid);
            })
            ->count();

        $completedtasks = Task::whereIn('status', ['completed'])
            ->whereHas('assignedusers', function ($query) use ($loggedUserid) {
                $query->where('user_id', $loggedUserid);
            })
            ->count();


        return view('dashboard.index', compact('usersCount', 'agentsCount', 'backOfficeCount', 'AccountingCount', 'teamLeadCount', 'Pendingtasks', 'completedtasks'));
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function Profile()
    {
        $loggedUserid = Auth::user()->id;
        $loggedUserData = User::with('role')->find($loggedUserid);

        // for roles dropDown
        $roles = Role::all();
        // return $roles;
        return view('dashboard.profile', compact('loggedUserData', 'roles'));
    }

    public function UpdateProfile(Request $req)
    {
        $data = $req->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
        ]);

        $user =  User::find(Auth::user()->id);
        $user->update($data);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function ChangePassword()
    {
        return view('dashboard.change-password');
    }

    public function ProcessChangePassword(Request $req)
    {
        $passData = $req->validate([
            'current_password' => 'required|string|min:6',
            'password' => 'required|string|min:6|confirmed', // "confirmed" rule needs "password_confirmation"
        ]);

        $user = Auth::user();
        // dd($req->all());
        $userpass = User::find(Auth::user()->id);

        if (!Hash::check($req->current_password, $userpass->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        $userpass->update([
            'password' => Hash::make($req->password),
        ]);

        return back()->with('success', 'Password changed successfully.');
    }

    public function Upload(Request $request)
    {
        // Validate image
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        
        // Store image
        $file = $request->file('profile_picture');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        
        // Define the directory to store the image
        $destinationPath = public_path('dashboard/uploads/profile_pictures');
        
        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true); // Create the directory if it does not exist
        }
        
        // Move the file to the destination path
        $file->move($destinationPath, $filename);
    
        // Update user model

        $user = User::find(Auth::id());
       
        $user->profile_pic = 'dashboard/uploads/profile_pictures/' . $filename; // Save relative path
        $user->save();
    
        return back()->with('success', 'Profile picture updated successfully!');
    }
}
