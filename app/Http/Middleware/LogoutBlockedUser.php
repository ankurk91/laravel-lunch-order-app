<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class LogoutBlockedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard()->check() && Auth::user()->is_blocked) {
            // Logout this user
            Auth::logout();

            if ($request->wantsJson() || $request->expectsJson()) {
                return response()->json(['error' => 'Unauthenticated.'], 401);
            }

            alert()->error('You no longer have access to your account.');
            return redirect()->route('login');
        }

        return $next($request);
    }
}
