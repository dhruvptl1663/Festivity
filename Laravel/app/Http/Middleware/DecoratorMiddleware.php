<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DecoratorMiddleware
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
        // First check if decorator is logged in
        if (!Auth::guard('decorator')->check()) {
            // If a session exists but it's not valid, clear it to prevent session confusion
            if (Session::has('decorator_id')) {
                Session::forget('decorator_id');
            }
            
            // Store the intended URL to redirect back after login
            if (!$request->is('decorator/login') && !$request->is('decorator/register')) {
                Session::put('url.intended', $request->url());
            }
            
            return redirect()->route('decorator.login')
                ->with('error', 'You must be logged in as a decorator to access this page.');
        }
        
        // Store decorator ID in session for quick access
        Session::put('decorator_id', Auth::guard('decorator')->id());
        
        // Ensure decorator view shares are available
        app('view')->share('decorator', Auth::guard('decorator')->user());

        return $next($request);
    }
}
