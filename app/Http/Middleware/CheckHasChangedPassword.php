<?php

namespace App\Http\Middleware;

use Closure;

class CheckHasChangedPassword
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
        if (auth()->user() && !$request->routeIs('profile.senha','profile.senhaNova', 'logout')) {
            if(auth()->user()->login == 1){
                return redirect()->route('profile.senha')->with('message_warning_password', 'Você está usando a senha criada pelo sistema, mude sua senha aqui para acessar o sistema.');
            }
        }

        return $next($request);

    }
}
