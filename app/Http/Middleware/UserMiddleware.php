<?php

namespace App\Http\Middleware;

use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!$request->bearerToken()->exists()) {
            return response()->json([
                'message' => 'Пользователь не авторизирован'
            ], 401);
        }

        return $next($request);
    }
}
