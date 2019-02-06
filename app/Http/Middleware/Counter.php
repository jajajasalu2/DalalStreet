<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use \DB;

class Counter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$guard=null)
    {
    if (Auth::guard($guard)->guest()) {
        if ($request->ajax()) {
            return response('Unauthorized.', 401);
        } else {
            return redirect()->guest('login');
        }
	} 
	    else if (Auth::guard($guard)->user()->role==3) {
    			
	    }
        return $next($request);
    }
}
<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin  
{
  public function handle($request, Closure $next, $guard = null)
  {
    else if (Auth::guard($guard)->user()->role = 1) {
        return redirect()->to('/')->withError('Permission Denied');
    }
    return $next($request);
  }
}
