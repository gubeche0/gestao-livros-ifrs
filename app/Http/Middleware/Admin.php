<?php

namespace App\Http\Middleware;

use Closure;
use Session;

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
        if(auth()->user()->tipo == 2){
          return $next($request);
        }
          Session::flash('message_danger', 'Você não possui permissão para acessar essa página.');
          return redirect('home');
      }
}
