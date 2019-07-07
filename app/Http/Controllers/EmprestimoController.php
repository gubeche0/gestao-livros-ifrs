<?php

namespace App\Http\Controllers;

use App\Aluno;
use App\Exemplar;
use App\Emprestimo;
use Illuminate\Http\Request;
use App\Http\Requests\EmprestimoLoanRequest;
use App\Http\Requests\EmprestimoDevolutionRequest;

class EmprestimoController extends Controller
{
    
    public function index()
    {
        $emprestimos = Emprestimo::all();
        return view('emprestimo.index', compact('emprestimos'));
    }

    
    public function loan()
    {
        $alunos = Aluno::all();
        return view('emprestimo.loan', compact('alunos'));
    }

    
    public function registerLoan(EmprestimoLoanRequest $request)
    {
        $emprestimos = new Emprestimo();
        $emprestimos->aluno()->associate($request['aluno']);
        $emprestimos->exemplar()->associate($request['exemplar']);
        $emprestimos->user_id = auth()->user()->id;
        $emprestimos->periodo_entrega = $request['periodoEntrega'];
        $emprestimos->save();

        return redirect()->route('emprestimo.index')->
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

        $status = isset($_POST['statusLivro']) ? $_POST['idEmprestimo'] : 'Não Utilizavel';
        if($status == 'Não Utilizavel') {
            $exemplar = Exemplar::findOrFail($request['idExemplar']);
            $exemplar->status = $status;
            $exemplar->save();
            $exemplar->delete();
        }

        return redirect()->route('emprestimo.index')->
            with('success', ['Emprestimo devolvido com sucesso!']);
    }


}
