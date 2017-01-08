<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
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
        if($request->user() === null) {
            return redirect('/');
        }
        
        $actions = $request->route()->getAction();
        $role = $actions['role'];
        
        if($request->user()->role == 'admin' || !$role) {
            return $next($request);
        }
        
        return redirect('/');
    }
}
