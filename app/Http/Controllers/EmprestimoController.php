<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Curso;
use App\Exemplar;
use App\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoLoanRequest;
use App\Http\Requests\EmprestimoDevolutionRequest;
use App\Turma;
use App\Livro;

class EmprestimoController extends Controller
{
    
    public function index()
    {
        $emprestimos = Emprestimo::all();
        return view('emprestimo.index', compact('emprestimos'));
    }

    
    public function loan()
    { 
        $turmas = Turma::orderBy('curso_id')->orderBy('nome')->get();
        $alunos = Aluno::all();
        $cursos = Curso::with('alunos')->get();
        return view('emprestimo.loan', compact('alunos', 'turmas', 'cursos'));
    }

    
    public function registerLoan(EmprestimoLoanRequest $request)
    {
        $exemplar = Exemplar::findOrFail($request['exemplar'])
            ->livro->exemplares()
            ->join('emprestimos', 'exemplar_code', 'code')
            ->where('emprestimos.aluno_id', '=', $request['aluno'])
            ->get();
        
        if ($exemplar->count() >= 1 && $request->input('forceSave') == 'false') {
            $request->flash();
            return redirect()->route('emprestimo.loan')->with('alunoHasLivro', true)->withInput();
        }
        Emprestimo::create([
            'aluno_id' => $request['aluno'], 
            'exemplar_code' => $request['exemplar'],
            'turma_id' => $request['turma']
        ]);
        $request->flash();

        return redirect()->route('emprestimo.loan')->
            with('success', ['Emprestimo registrado com sucesso!'])->withInput(['turma' => $request->input('turma')]);
    }

    
    public function show($id)
    {
        //
    }

    
    public function devolution()
    {
        return view('emprestimo.devolution');
    }

    
    public function registerDevolution(EmprestimoDevolutionRequest $request)
    {
        $emprestimos = Emprestimo::findOrFail($request['idEmprestimo']);
        
        $emprestimos->delete();

        if(!$request->has('statusLivro')) {
            $exemplar = Exemplar::findOrFail($request->input('idExemplar'));
            $exemplar->status = 'Não Utilizavel';
            $exemplar->save();
            $exemplar->delete();
        }

        return redirect()->route('emprestimo.devolution')->
            with('success', ['Emprestimo devolvido com sucesso!']);
    }


}
