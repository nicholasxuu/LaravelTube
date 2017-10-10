<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string $requiredLevel
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $requiredLevel)
    {
        if ($request->user()->level < intval($requiredLevel)) {
            return response('Unauthorized.', 401);
        }

        return $next($request);
    }
}
