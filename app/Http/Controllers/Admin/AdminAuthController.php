<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function showLogin()
    {
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }

        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $usernameMatch = $request->username === config('admin.username');
        $passwordMatch = Hash::check($request->password, config('admin.password'));

        if ($usernameMatch && $passwordMatch) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        $request->session()->forget('admin_logged_in');
        return redirect()->route('admin.login');
    }
}