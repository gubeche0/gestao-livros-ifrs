<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PerfilController extends Controller
{
    public function index()
    {
        return view('profile.index');
    }

    public function update(Request $request)
    {
        auth()->user()->update($request->all());

        Session::flash('message_success_perfil', 'Perfil atualizado com sucesso!');
        return back();
    }

    public function password(Request $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        Session::flash('message_success_senha', 'Senha atualizada com sucesso!');
        return back();
    }
}
