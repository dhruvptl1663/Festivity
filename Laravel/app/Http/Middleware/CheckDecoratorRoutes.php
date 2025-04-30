<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckDecoratorRoutes
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
        // Process the request
        $response = $next($request);

        // If the response is a redirect to login but we're in decorator routes
        if ($response->isRedirect(route('login')) && $request->is('decorator*')) {
            // Redirect to decorator login instead
            return redirect()->route('decorator.login');
        }

        return $response;
    }
}
