<?php

namespace App\Http\Middleware;

use Closure;

class CustomerAuth
{
    public function handle($request, Closure $next)
    {
        if (!auth('web')->check()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'requires_login' => true,
                    'message' => 'Vui lòng đăng nhập để sử dụng chức năng này.',
                ], 401);
            }

            return redirect()->route('homepage.index');
        }
        return $next($request);
    }
}
