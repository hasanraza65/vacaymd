<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Closure;
use Auth;

class RedirectToRoleBasedUrlCustom
{
    public function handle(Request $request, Closure $next)
    {
        // If the user is not logged in, proceed to the next middleware
        if (!auth()->check()) {
            return $next($request);
        }

        // Redirect the user based on their role
        switch (auth()->user()->user_role) {
            case 1: // Admin role
                return redirect('/admin');

            case 2: // Doctor role
                return redirect('/doctor');

            case 3: // Pharamacy Manager role
                return redirect('/pharmacy');

            case 4: // Patient role
                return redirect('/patient');

            default:
                return $next($request);
        }
    }
}
