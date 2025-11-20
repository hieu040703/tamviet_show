<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $user = Auth::guard('admin')->user();
        if (!$user || !$user->hasRole($role)) {
            abort(403, 'Bạn không có vai trò phù hợp.');
        }
        return $next($request);
    }
}
