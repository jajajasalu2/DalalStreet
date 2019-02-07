<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Counter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null) {
    if (Auth::guard($guard)->guest()) {
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } 
	else {
            return redirect()->guest('login');
        }
    } 
    else if (Auth::guard($guard)->user()->role == 3) {
        return back()->with('error','For transactions please proceed to a counter');
    }	
	return $next($request);
    }
}
