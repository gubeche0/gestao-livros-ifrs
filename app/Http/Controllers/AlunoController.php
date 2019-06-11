<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Aluno;
use App\Curso;

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

    public function store(Request $request)
    {
        $aluno = new Aluno();
        $aluno->matricula = $request->input('matricula');
        $aluno->nome = $request->input('nome');
        $aluno->email = $request->input('email');
        $aluno->curso_id = $request->input('curso');
        $aluno->user_id = auth()->user()->id;
        $aluno->save();
        return redirect()->route('aluno.index')->
            with('success', ['Aluno(a) cadastrado(a) com sucesso!']);

    }

    public function show(Aluno $aluno)
    {
        //
    }

    
    public function edit(Aluno $aluno)
    {

        $cursos = Curso::all();
        return view('aluno.form', compact(['aluno', 'cursos']));
    }

    
    public function update(Request $request, Aluno $aluno)
    {
        $aluno->nome = $request->input('nome');
        $aluno->email = $request->input('email');
        $aluno->curso_id = $request->input('curso');
        $aluno->user_id = auth()->user()->id;
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
