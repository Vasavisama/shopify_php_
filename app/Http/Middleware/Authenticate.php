<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
{
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }
        Log::info('Redirecting unauthenticated user to login');
        return route('login');
    }

    protected function authenticate($request, array $guards)
    {
        if (empty($guards)) {
            $guards = [null]; // Default to api guard
        }

        foreach ($guards as $guard) {
            if ($guard === 'api' || $guard === null) {
                if ($token = session('jwt_token')) {
                    try {
                        JWTAuth::setToken($token);
                        $user = JWTAuth::authenticate();
                        if (!$user) {
                            Log::error('Authentication failed: No user found for token');
                            session()->forget('jwt_token');
                            $this->unauthenticated($request, ['api']);
                        }
                        auth('api')->setUser($user);
                        Log::info('User authenticated via middleware:', ['user_id' => $user->id, 'role' => $user->role]);
                        return;
                    } catch (\Exception $e) {
                        Log::error('Authentication failed: ' . $e->getMessage());
                        session()->forget('jwt_token');
                        $this->unauthenticated($request, ['api']);
                    }
                } else {
                    Log::warning('No JWT token found in session');
                    $this->unauthenticated($request, ['api']);
                }
            }
        }

        $this->unauthenticated($request, $guards);
    }
}
