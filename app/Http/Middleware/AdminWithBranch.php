<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class AdminWithBranch
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$branches)
    {
        $user = Auth::user();

        if ($user && $user->role === 'Admin' && in_array($user->branch, $branches)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }
}
