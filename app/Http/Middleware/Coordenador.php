<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Coordenador
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
        if(auth()->user()->tipo == 3){
            return $next($request);
          }
          Session::flash('message_danger', 'Você não possui permissão para acessar essa página.');
          return redirect('home');
    }
}
