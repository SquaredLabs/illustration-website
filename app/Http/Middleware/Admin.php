<?php

namespace app\Http\Middleware;

use App\User;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Support\Facades\Log;

class Admin
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
        // if the laravel auth session is still valid, nothing else matters just pass the request
        $user = Auth::User();
        if(!$user){
          return response('Please login first', 401);
        }
        if ($user->admin) {
            return $next($request);
        }
        else {
          return response('You are not permitted to access this page.', 403);
        }
    }
}
