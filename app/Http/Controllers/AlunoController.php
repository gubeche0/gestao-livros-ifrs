<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use App\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\AlunoRequest;

class AlunoController extends Controller
{

    public function index()
    {
        $alunos = Aluno::all();
        return view('aluno.index', compact('alunos'));
    }

    public function create()
    {
        $cursos = Curso::all();
        return view('aluno.form', compact('cursos'));
    }

    public function store(AlunoRequest $request)
    {
        Aluno::create([
            'matricula' => $request['matricula'], 
            'nome' => $request['nome'], 
            'email' => $request['email'], 
            'curso_id' => $request['curso'],
        ]);
        return redirect()->route('aluno.index')->
            with('success', ['Aluno(a) cadastrado(a) com sucesso!']);

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
