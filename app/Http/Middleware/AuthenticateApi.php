<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateApi
{
    public function handle(Request $request, Closure $next)
    {
        $authorizationHeader = $request->bearerToken();
        if (!$authorizationHeader) {
            return response()->json(['error' => 'Authorization header not found'], 401);
        }

        $authorizationHeaderParts = explode(' ', $authorizationHeader);
        if (count($authorizationHeaderParts) < 2) {
            return response()->json(['error' => 'Invalid authorization header format'], 401);
        }

        $token = $authorizationHeaderParts[1];
        if (Auth::guard('api')->check()) {
            return $next($request);
        } else {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
