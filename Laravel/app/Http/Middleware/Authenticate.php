<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Handle an unauthenticated user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $guards
     * @return void
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    protected function unauthenticated($request, array $guards)
    {
        if ($request->expectsJson()) {
            abort(401, 'Unauthenticated.');
        }

        // Determine the guard that should be used
        if (in_array('admin', $guards)) {
            return redirect()->route('admin.login');
        }

        if (in_array('decorator', $guards)) {
            return redirect()->route('decorator.login');
        }

        return redirect()->route('login');
    }

    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Determine the appropriate login route based on the URL pattern
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }
            
            if ($request->is('decorator') || $request->is('decorator/*')) {
                return route('decorator.login');
            }
            
            // Default to standard user login
            return route('login');
        }
        
        return null;
    }
}
