<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use App\User;

class Prof
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
      if(auth()->user()->isTipo(User::PROFESSOR, User::COORDENADOR, User::ADMINISTRADOR )){
        return $next($request);
      }
      Session::flash('message_danger', 'Você não possui permissão para acessar essa página.');
      return redirect('home');
    }
}
