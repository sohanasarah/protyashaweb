<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->user_role == 'admin') {
                return redirect('/admin');
            }
            else if (Auth::user()->user_role == 'depot-in-charge') {
                return redirect('/depot');
            }
            else if (Auth::user()->user_role == 'divisional_manager') {
                return redirect('/division');
            }
            else if (Auth::user()->user_role == 'marketing') {
                return redirect('/marketing');
            }

        }

        return $next($request);
    }
}
