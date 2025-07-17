<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        $roles = explode('|', $role);

        if (!auth()->check() || !in_array(auth()->user()->role, $roles)) {
            abort(403, 'You do not have the required role.');
        }

        return $next($request);
    }
}

