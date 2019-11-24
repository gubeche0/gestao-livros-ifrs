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
        if(auth()->user()->login == 1){

            $user = User::find(auth()->user()->id);
            $user->update([
                'login' => 0,
            ]);

            Session::flash('message_warning_password', 'Essa é a primeira vez que você se loga, edite sua senha aqui.');
            


            return redirect()->route('profile.index');
        }
        if(auth()->user()->tipo == 1){
            return view ('homeCoord');
        }
        dd('oi');
        return view('home');
    }
}
