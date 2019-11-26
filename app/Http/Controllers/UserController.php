<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\PasswordMail;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('id', [auth()->user()->id])->get();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.form');
    }

    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $password = bin2hex(random_bytes(4));
            User::create([
                'name' => $request['name'], 
                'email' => $request['email'],
                'password' => Hash::make($password),
                'tipo' => $request['tipo'],
                'login' => 1,
            ]);

            Mail::to($request['email'])->send(new PasswordMail($password, $request['email']));     
            DB::commit();            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('user.create')->
                with('erros', ['Não foi possivel criar o usúario!'])->withInput();
        }
        
        return redirect()->route('user.create')->
            with('success', ['Usuário cadastrado com sucesso!'])->withInput();
    }
    
    public function edit(User $user)
    {
        return view('user.form', compact(['user']));
    }

    
    public function update(UserRequest $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->tipo = $request->input('tipo');
        $user->save();
        return redirect()->route('user.index')->
            with('success', ['Usuário alterado com sucesso!']);
    }

    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->
            with('success', ['Usuário deletado com sucesso!']);
    }
}
