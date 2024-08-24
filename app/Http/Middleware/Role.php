<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Log;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     * @param string[] $permissions
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if (Auth::check()) {
            $user = auth()->user();

            foreach ($permissions as $permission) {
                // Check if the user has the specified role or belongs to the specified branch
                if ($this->hasPermission($user, $permission)) {
                    return $next($request);
                }
            }

            abort(403, 'Unauthorized');
        } else {
            abort(401, 'Unauthenticated');
        }
    }

    /**
     * Check if the user has the specified role or belongs to the specified branch.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable|null $user
     * @param string $permission
     * @return bool
     */
    private function hasPermission($user, $permission)
    {
        // Split the permission into role and branch
        $parts = explode(':', $permission);
        $role = $parts[0];
        $branch = $parts[1] ?? null;

        // Check if the user has the specified role
        if ($role && $user->role === $role) {
            return true;
        }

        // Check if the user belongs to the specified branch
        if ($branch && $user->branch === $branch) {
            return true;
        }

        return false;
    }
}
