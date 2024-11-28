<?php
namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class JwtExclusionMiddleware
{
    public function handle($request, Closure $next)
    {
        $operationName = $request->input('operationName');

        // If operationName is not explicitly provided, extract it from the query
        if (!$operationName) {
            $query = $request->input('query'); 
            // print_r($query = $request->input('query'));
            preg_match('/login/i', $query, $matches);

            // print_r(preg_match('/login/i', $query));exit;
            $operationName = $matches[0] ?? null; // Second match is the operation name
        }

        // Skip JWT authentication for the 'login' operation
        // print_r($matches);exit;
        if ($operationName === 'login') {
            return $next($request);
        }
        // Check if the route is 'login' and exclude JWT for this route
        if ($request->route()->getName() == 'graphql.login') {
            return $next($request);  // Skip JWT authentication for login
        }

        // Otherwise, proceed with normal JWT authentication
        try {
            JWTAuth::parseToken()->authenticate(); // Authenticate user via JWT token
        } catch (\Exception $e) {
            throw new UnauthorizedHttpException('jwt-auth', 'Token not provided or invalid');
        }

        return $next($request);
    }

    private function containsLoginMutation(?string $query): bool
    {
        if (!$query) {
            return false;
        }

        // Check if the query includes a `mutation` and the `login` operation
        return preg_match('/mutation\s*\{.*login\s*\(/', $query);
    }
}
