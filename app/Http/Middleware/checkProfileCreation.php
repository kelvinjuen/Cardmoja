<?php

namespace App\Http\Middleware;

use Closure;

class checkProfileCreation
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
        if ($request->user() && $request->user()->active == 0) {
            if($request->user()->type == 'personal'){
                return redirect('/card/create');
            }elseif($request->user()->type == 'coperate_user'){
                return redirect('/coperateuser/create');
            }elseif($request->user()->type == 'coperate'){
                return redirect('/coperate/create');
            }

        }
        return $next($request);
    }
}
