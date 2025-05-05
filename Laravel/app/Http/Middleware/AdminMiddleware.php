<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminMiddleware
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
        // Check if admin is logged in
        if (!Auth::guard('admin')->check()) {
            // If a session exists but it's not valid, clear it to prevent session confusion
            if (Session::has('admin_id')) {
                Session::forget('admin_id');
            }
            
            // Store the intended URL to redirect back after login
            if (!$request->is('admin/login')) {
                Session::put('url.intended', $request->url());
            }
            
            return redirect()->route('admin.login')
                ->with('error', 'You must be logged in as an admin to access this page.');
        }
        
        // Store admin ID in session for quick access
        Session::put('admin_id', Auth::guard('admin')->id());
        
        // Ensure admin-specific view data is available
        app('view')->share('admin', Auth::guard('admin')->user());
        
        return $next($request);
    }
}
