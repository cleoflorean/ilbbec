<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (!$user) {
            abort(403);
        }

        $normalizedUserRole = strtolower(trim((string) $user->Role));
        $normalizedRoles = array_map(fn (string $role) => strtolower(trim($role)), $roles);

        if (!in_array($normalizedUserRole, $normalizedRoles, true)) {
            abort(403);
        }

        return $next($request);
    }
}