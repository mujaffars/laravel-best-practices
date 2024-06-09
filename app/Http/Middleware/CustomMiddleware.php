<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Filter requests based on custom logic
        if (!$this->isRequestAllowed($request)) {
            return response()->json(['error' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        // Perform authentication
        // if (!$this->authenticate($request)) {
        //     return response()->json(['error' => 'Authentication Failed'], Response::HTTP_FORBIDDEN);
        // }

        return $next($request);
    }

    /**
     * Check if the request is allowed.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isRequestAllowed(Request $request)
    {
        // Add custom request filtering logic here
        // For example, allow only specific IP addresses

        $allowedIps = ['127.0.0.1', '123.456.789.0', '987.654.321.0'];
        return in_array($request->ip(), $allowedIps);
    }

    /**
     * Authenticate the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function authenticate(Request $request)
    {
        // Add custom authentication logic here
        // For example, check for a specific token in the headers
        $token = $request->header('X-Auth-Token');
        return $token === 'your-secret-token';
    }
}
