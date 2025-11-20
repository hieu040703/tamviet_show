<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('backend.auth.login');
    }

    public function login(LoginRequest $request)
    {
        $remember = $request->has('remember');
        $credentials['password'] = $request->get('password');
        if (filter_var($request->get('username'), FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $request->get('username');
        } else {
            $credentials['name'] = $request->get('username');
        }
        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            return redirect()
                ->route('admin.backend.home')
                ->with('success', __("Login Success"));
        }
        return back()->with('error', __("Login Fail"));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return back()->with('success', __("Logout Success"));
    }

}
