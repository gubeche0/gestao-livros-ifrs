<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Exemplar;
use App\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoLoanRequest;
use App\Http\Requests\EmprestimoDevolutionRequest;
use App\Turma;

class EmprestimoController extends Controller
{
    
    public function index()
    {
        $emprestimos = Emprestimo::all();
        return view('emprestimo.index', compact('emprestimos'));
    }

    
    public function loan()
    { 
        $turmas = Turma::where('active', true)->orderBy('curso_id')->orderBy('nome')->get();
        $alunos = Aluno::all();
        return view('emprestimo.loan', compact('alunos', 'turmas'));
    }

    
    public function registerLoan(EmprestimoLoanRequest $request)
    {
        // dd($request);
        Emprestimo::create([
            'aluno_id' => $request['aluno'], 
            'exemplar_code' => $request['exemplar'],
            'turma_id' => $request['turma']
        ]);

        return redirect()->route('emprestimo.loan')->
            with('success', ['Emprestimo registrado com sucesso!']);
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
