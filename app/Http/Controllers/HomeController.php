<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(auth()->user()->tipo == 1){
            return view ('homeCoord');
        }
        if(auth()->user()->tipo == 2){
            return view ('homeAdmin');
        }
        dd('home ainda não criada');
        return view('home');
    }
}
