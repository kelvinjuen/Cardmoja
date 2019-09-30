<?php

namespace App\Http\Middleware;

use Closure;

class CoperateUserMiddleware
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
        if ($request->user() && $request->user()->type != ‘coperate_user’){

            return new Response(view(‘unauthorized’)->with(‘role’, ‘CoperateUser’));

        }
        return $next($request);
    }
}
