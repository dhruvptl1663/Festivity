<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PreventCrossUserAccess
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
        // Check if regular user is logged in and trying to access admin or decorator routes
        if (Auth::guard('web')->check()) {
            if ($request->is('admin') || $request->is('admin/*') || 
                $request->is('decorator') || $request->is('decorator/*')) {
                
                Auth::guard('web')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                if ($request->is('admin') || $request->is('admin/*')) {
                    return redirect()->route('admin.login')
                        ->with('error', 'Regular users cannot access admin pages. Please login as an admin.');
                }
                
                if ($request->is('decorator') || $request->is('decorator/*')) {
                    return redirect()->route('decorator.login')
                        ->with('error', 'Regular users cannot access decorator pages. Please login as a decorator.');
                }
            }
        }
        
        // Check if admin is logged in and trying to access user or decorator routes
        if (Auth::guard('admin')->check()) {
            if ((!$request->is('admin') && !$request->is('admin/*')) && 
                ($request->is('decorator') || $request->is('decorator/*'))) {
                
                Auth::guard('admin')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                if ($request->is('decorator') || $request->is('decorator/*')) {
                    return redirect()->route('decorator.login')
                        ->with('error', 'Admins cannot access decorator pages. Please login as a decorator.');
                } else {
                    return redirect()->route('login')
                        ->with('error', 'Admins cannot access regular user pages. Please login as a user.');
                }
            }
        }
        
        // Check if decorator is logged in and trying to access user or admin routes
        if (Auth::guard('decorator')->check()) {
            if ((!$request->is('decorator') && !$request->is('decorator/*')) && 
                ($request->is('admin') || $request->is('admin/*'))) {
                
                Auth::guard('decorator')->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                
                if ($request->is('admin') || $request->is('admin/*')) {
                    return redirect()->route('admin.login')
                        ->with('error', 'Decorators cannot access admin pages. Please login as an admin.');
                } else {
                    return redirect()->route('login')
                        ->with('error', 'Decorators cannot access regular user pages. Please login as a user.');
                }
            }
        }
        
        return $next($request);
    }
}
