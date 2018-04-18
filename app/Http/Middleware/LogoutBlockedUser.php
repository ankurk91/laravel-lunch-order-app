<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LogoutBlockedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @throws \Illuminate\Auth\AuthenticationException
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check() &&
            Auth::guard($guard)->user()->is_blocked) {

            Auth::guard($guard)->logout();
            $request->session()->invalidate();

            alert()->error('You no longer have access to your account.');
            throw new AuthenticationException;
        }

        return $next($request);
    }
}
