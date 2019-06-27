<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class DepotMiddleware
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
        $user = Auth::user();

        if($user->user_role == 'depot-in-charge'){
            return $next($request);
        }
        else{
            // abort(403, 'Wrong Accept Header');
            return new Response(view('unauthorized')->with('role', 'depot-in-charge'));
        }
    }
}