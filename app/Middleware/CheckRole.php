<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Role;

class CheckRole
{
    public function handle(Request $request, Closure $next, string $roleName): Response
    {
        // Mapea nombres de roles a IDs
        $roleMapping = [
            'admin' => Role::ADMIN,
            'editor' => Role::EDITOR,
            'guest' => Role::GUEST
        ];

        if (!array_key_exists($roleName, $roleMapping)) {
            abort(403, 'Rol no válido');
        }

        $requiredRoleId = $roleMapping[$roleName];

        if (!$request->user() || $request->user()->role_id !== $requiredRoleId) {
            abort(403);
        }

        return $next($request);
    }
}
