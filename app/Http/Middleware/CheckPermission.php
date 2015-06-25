<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $permission)
    {
        $user = $request->user();

        if ($user && $user->hasPermission($permission)){
            return $next($request);
        }else{
            flash()->warning('Opa! Você não tem permissão para acessar isso.')->important();
            return redirect('dashboard');
        }

        return $next($request);
    }
}