<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect()->route('login')->withErrors(['access' => 'Bạn không có quyền truy cập']);
        }

        return $next($request);
    }
}