<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AdminMiddleware
{/**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            // Check if the token is valid and decode it
            $user = JWTAuth::parseToken()->authenticate();

            if ($user->type_id !== 1) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } catch (JWTException $e) {
            return response()->json(['error' => 'Token is invalid'], 403);
        }

        return $next($request);
    }
}