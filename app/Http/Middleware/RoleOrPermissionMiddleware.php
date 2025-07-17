<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleOrPermissionMiddleware
{
    public function handle(Request $request, Closure $next, $value): Response
    {
        if (!auth()->check()) {
            abort(403, 'Unauthorized');
        }

        $user = auth()->user();
        $items = explode('|', $value);

        $hasRole = in_array($user->role, $items);
        $hasPermission = method_exists($user, 'hasPermission') && $user->hasPermission($value);

        if (!$hasRole && !$hasPermission) {
            abort(403, 'You lack both the role and permission.');
        }

        return $next($request);
    }
}
