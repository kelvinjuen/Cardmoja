<?php

namespace App\Http\Middleware;

use Closure;

class personalMiddleware
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
        if ($request->user() && $request->user()->type != ‘personal’){

            return new Response(view(‘unauthorized’)->with(‘role’, ‘User’));

        }
        return $next($request);
    }
}
