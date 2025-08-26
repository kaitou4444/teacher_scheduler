<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User; // Giữ lại import này
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateApi
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();
        $user = User::where('api_token', $token)->first();

        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        Auth::login($user);
        return $next($request);
    }
}