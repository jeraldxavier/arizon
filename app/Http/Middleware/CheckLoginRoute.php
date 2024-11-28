<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckLoginRoute
{
    public function handle($request, Closure $next)
    {
        // Check if the route is 'graphql.login'
        if ($request->route()->getName() == 'graphql.login') {
            // Skip JWT authentication for login route
            return $next($request);
        }

        // Apply JWT middleware for all other routes
        if (!$token = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
