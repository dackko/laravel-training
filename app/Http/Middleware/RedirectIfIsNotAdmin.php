<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfIsNotAdmin
{
    /**
     * Handle an incoming request.
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->get('admin') === 'da') {
            return $next($request);
        }

        return abort(403);
    }
}
