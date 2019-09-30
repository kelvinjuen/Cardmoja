<?php

namespace App\Http\Middleware;

use Closure;

class CoperateMiddleware
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
        if ($request->user() && $request->user()->type != ‘coperate’){

            return new Response(view(‘unauthorized’)->with(‘role’, ‘CoperateAdminstrator’));

        }
        return $next($request);
    }
}
