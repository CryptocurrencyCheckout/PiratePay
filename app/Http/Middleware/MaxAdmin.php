<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class MaxAdmin
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
        $users = User::count();

        if ($users > 0){

            return redirect('/')->with('error', 'Maximum quantity of Admins already registered!');
            
        }


        return $next($request);
    }
}
