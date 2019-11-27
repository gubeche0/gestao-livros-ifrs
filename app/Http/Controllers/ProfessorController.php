<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\PasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ProfessorRequest;

class ProfessorController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('id', [auth()->user()->id])
        ->where('tipo', 3)
        ->orWhere('tipo', 4)
        ->get();
        return view('professor.index', compact('users'));
    }

    public function create()
    {
        return view('professor.form');
    }

    public function store(ProfessorRequest $request)
    {
        DB::beginTransaction();
        try {
            $password = bin2hex(random_bytes(4));
            User::create([
                'name' => $request['name'], 
                'email' => $request['email'],
                'password' => Hash::make($password),
                'tipo' => 4,
                'login' => 1,
            ]);

            Mail::to($request['email'])->send(new PasswordMail($password, $request['email']));     
            DB::commit();            
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('professor.create')->
                with('erros', ['Não foi possivel criar o usúario!'])->withInput();
        }
        
        return redirect()->route('professor.create')->
            with('success', ['Professor cadastrado com sucesso!'])->withInput();
    }
    
    public function edit(User $user)
    {
        return view('professor.form', compact(['user']));
    }

    
    public function update(ProfessorRequest $request, User $user)
    {
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect()->route('professor.index')->
            with('success', ['Professor alterado com sucesso!']);
    }
    
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('professor.index')->
            with('success', ['Professor deletado com sucesso!']);
    }
}
