<?php

namespace App\Http\Middleware;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

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
          $user=User::find($request->user()->id);

        if($user->roles()->where('rolename','Administrator')
              ->count()==0)
        {
            return response()->view('errors.authorizationerror');
        }
        return $next($request);

    }
}
