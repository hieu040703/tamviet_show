<?php

namespace App\Http\Controllers\Ajax\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function ajaxLogin(Request $request)
    {
        $data = $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $user = $this->findCustomerByLogin($data['login']);

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return $this->error('Email/SĐT hoặc mật khẩu không chính xác', 422);
        }

        Auth::guard('web')->login($user, true);

        return $this->success([
            'redirect' => url('/'),
        ]);
    }

    public function ajaxRegister(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:customers,email'],
            'phone' => ['required', 'digits:10', 'unique:customers,phone'],
            'password' => ['required', 'min:6'],
        ]);
        $user = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);
        Auth::guard('web')->login($user);
        return response()->json([
            'success' => true,
            'redirect' => url('/'),
        ]);
    }
    public function ajaxLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'success' => true,
            'redirect' => url('/'),
        ]);
    }
    protected function findCustomerByLogin(string $login): ?Customer
    {
        $login = trim($login);
        $digits = preg_replace('/\D/', '', $login);

        if ($digits !== '' && ctype_digit($digits)) {
            return Customer::where('phone', $digits)->first();
        }

        return Customer::where('email', $login)->first();
    }

    protected function success(array $data = [], int $status = 200)
    {
        return response()->json(array_merge([
            'success' => true,
        ], $data), $status);
    }

    protected function error(string $message, int $status = 422)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
        ], $status);
    }
}
