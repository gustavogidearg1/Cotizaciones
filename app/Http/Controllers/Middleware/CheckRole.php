<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $roleId = match ($role) {
            'admin' => Role::ADMIN,
            'editor' => Role::EDITOR,
            'guest' => Role::GUEST,
            default => null,
        };

        if (!$request->user() || $request->user()->role_id !== $roleId) {
            abort(403);
        }

        return $next($request);
    }
}
