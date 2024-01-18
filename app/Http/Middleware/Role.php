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
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (Auth::check()) {
            $user = auth()->user();
            if (!in_array($user->role, $roles)) {       
                abort(403, 'Unauthorized');
            }
        } else {
            abort(401, 'Unauthenticated');
        }
        return $next($request);
    }

}
