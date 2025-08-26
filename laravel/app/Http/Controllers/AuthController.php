<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Giữ lại import này


class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            if (Auth::user()->role === 'manager') {
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }
            Auth::logout();
            return back()->withErrors(['username' => 'Chỉ quản trị viên được phép đăng nhập']);
        }
        return back()->withErrors(['username' => 'Sai thông tin đăng nhập']);
    }

    public function apiLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->generateApiToken();
            return response()->json([
                'token' => $token,
                'role' => $user->role,
                'user' => [
                    'id' => $user->id,
                    'username' => $user->username,
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                ]
            ]);
        }
        return response()->json(['error' => 'Sai thông tin đăng nhập'], 401);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}