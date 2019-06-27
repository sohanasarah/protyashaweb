<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class DivisionMiddleware
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
        if($user->user_role == 'divisional_manager'){
            return $next($request);
        }
        else{
            // abort(403, 'Wrong Accept Header');
            return new Response(view('unauthorized')->with('role', 'divisional_manager'));

        }
    }
}
