<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionMiddleware
{
    public function handle(Request $request, Closure $next, $permission): Response
    {
        if (!auth()->check() || !method_exists(auth()->user(), 'hasPermission') || !auth()->user()->hasPermission($permission)) {
            abort(403, 'You do not have the required permission.');
        }

        return $next($request);
    }
}
