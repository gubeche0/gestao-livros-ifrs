<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\PasswordMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.form');
    }

    public function store(Request $request)
    {
        $password = rand();
        User::create([
            'name' => $request['name'], 
            'email' => $request['email'],
            'password' => Hash::make($password),
            'tipo' => $request['tipo'],
            'login' => 1,
        ]);

        Mail::to($request['email'])->send(new PasswordMail($password, $request['email']));                 
        dd($password);

        return redirect()->route('user.create')->
            with('success', ['Usuário cadastrado com sucesso!'])->withInput();
    }

    public function show(Aluno $aluno)
    {
        $emprestimos = Emprestimo::where('aluno_id', $aluno->id)
        ->withTrashed()
        ->orderBy('deleted_at')
        ->orderBy('exemplar_code')
        ->get();
        return view('aluno.info', compact('aluno', 'emprestimos'));
    }
    
    public function edit(Aluno $aluno)
    {

        $cursos = Curso::all();
        return view('aluno.form', compact(['aluno', 'cursos']));
    }

    
    public function update(AlunoRequest $request, Aluno $aluno)
    {
        $aluno->nome = $request->input('nome');
        $aluno->email = $request->input('email');
        $aluno->curso_id = $request->input('curso');
        $aluno->save();
        return redirect()->route('aluno.index')->
            with('success', ['Aluno(a) alterado(a) com sucesso!']);
    }

    
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('aluno.index')->
            with('success', ['Aluno(a) deletado(a) com sucesso!']);
    }
}
