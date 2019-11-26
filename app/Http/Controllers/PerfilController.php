<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\SenhaRequest;

class PerfilController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        Session::flash('message_success_perfil', 'Perfil atualizado com sucesso!');
        return back();
    }

    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        Session::flash('message_success_senha', 'Senha atualizada com sucesso!');
        return back();
    }
    public function senha()
    {
        if(auth()->user()->login == 0){
            return redirect()->route('home');
        }

        return view('profile.senha');
    }

    public function senhaNova(SenhaRequest $request)
    {
        auth()->user()->update([
            'password' => Hash::make($request->get('password')),
            'login' => 0,
        ]);

        Session::flash('message_success_senha', 'Senha atualizada com sucesso!');
        return redirect()->route('home');
    }
}
