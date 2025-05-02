<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (!$request->expectsJson()) {
            // Get the current guard name
            $guard = null;
            
            if ($request->is('admin') || $request->is('admin/*')) {
                return '/admin/login'; // Use absolute URL to ensure correct redirection
            }
            
            if ($request->is('decorator') || $request->is('decorator/*')) {
                return '/decorator/login'; // Use absolute URL to ensure correct redirection
            }
            
            // Default to standard user login
            return '/login';
        }
        
        return null;
    }
}
