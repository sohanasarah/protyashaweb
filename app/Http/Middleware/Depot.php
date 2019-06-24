<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Depot
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
        //print_r($request->user()->user_role);

        //$user = Auth::user();
        //$user_role =$request->user()->user_role ;

        // if ($request->user()->user_role !== 'depot-in-charge') {
        //     return redirect('/divisional-manager');
        // }
        return $next($request);
        /*
        elseif ($request->user()->user_role == 'divisional-manager') {
            return $next($request);
            //return redirect('/divisional-manager');
        }
        elseif ($request->user()->user_role == 'marketing') {
            return redirect('/marketing');
        }*/
    }

}