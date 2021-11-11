<?php

namespace App\Http\Middleware;


use Closure;
use Illuminate\Support\Facades\Auth;

class admin
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
        //verificar usuario se o login for admin ou empresa
        //if(Auth::check() && Auth::user()->temFuncao()=="admin")
        //{
            return $next($request);
       // }
        //return redirect('login');
    }
}
