<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class CheckOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $model)
    {
        $modelClass = 'App\\Models\\' . ucfirst($model);
        $id = $request->route('id');
        $resource = $modelClass::findOrFail($id);

        if ($resource->user_id !== Auth::user()->id) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
