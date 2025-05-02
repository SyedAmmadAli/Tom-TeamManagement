<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if (!Auth::check()) {
            return redirect()->route('login')->withErrors([
                'AuthError' => 'Unauthorized Access',
            ]);
        }
     
        if (Auth::check() && Auth::user()->status == 0) {
            Auth::logout();
            return redirect()->route('login')->withErrors([
                'AuthError' => 'Access Denied',
            ]);
        }

        // if (Auth::user()->role === 'Admin') {
        //     return redirect()->route('dashboard')->withErrors([
        //         'AuthError' => 'Unauthorized Access',
        //     ]);
        // }

       

        return $next($request);
    }
}
