<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = Auth::guard('admin')->user();
        if (!$user || !$user->hasPermission($permission)) {
            abort(403, 'Bạn không có quyền truy cập chức năng này.');
        }
        return $next($request);
    }
}
