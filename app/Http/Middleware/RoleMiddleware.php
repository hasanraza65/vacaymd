<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $user_role = Auth::user()->user_role;
        if ($user_role != $role) {
            return redirect('unauthorized');
        }

        return $next($request);
    }
}
