<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if user is authenticated and has admin role
        if ($request->user() && in_array($request->user()->role, ['admin', 'org_admin'])) {
            return $next($request);
        }

        if ($request->user()) {
            return redirect()->route('home');
        }

        return redirect()->route('login');
    }
}
