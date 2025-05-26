<?php

namespace App\Http\Middleware;

use App\Models\UserPermission;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userId = Auth::id();

        if (!$userId) {
            return redirect()->route('error403');
        }

        $user_permissions = UserPermission::with('permission')
            ->where('user_id', $userId)
            ->get();

        $useraccess = $user_permissions->pluck('permission.slug')->toArray();

        $currentPath = $request->path(); // e.g., "edit-task/16"
        $parts = explode('/', $currentPath);



        if (isset($parts[1]) && is_numeric($parts[1])) {
            $cleanPath = $parts[0]; // "edit-task"
            $currentPath = $cleanPath . '/'; 
        }
        // dd($useraccess, $currentPath);
        if (in_array($currentPath, $useraccess)) {
            return $next($request);
        }

        return redirect()->route('error403');
    }
}
