<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class AuthorizeToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (User::where(['api_key' => $request->get('api_key')])->count() > 0) {
            return $next($request);
        } else {
            abort(500);
        }
    }
}
