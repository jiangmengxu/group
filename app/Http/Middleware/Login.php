<?php

namespace App\Http\Middleware;

use Closure;

class Login
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
        //$session=session(['name'=>null]);
        //dd($session);
        if(!$request->session()->get('name')){
            return redirect('Goods/login');
        }
        return $next($request);
    }
    
}
