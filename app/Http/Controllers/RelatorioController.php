<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emprestimo;
use App\Turma;
use App\Livro;
use App\Aluno;
use Illuminate\Support\Facades\Input;


class RelatorioController extends Controller
{
    public function index()
    {
        $emprestimos = Emprestimo::join('exemplares', 'exemplares.code', '=', 'emprestimos.exemplar_code')->select('exemplares.livro_id', 'emprestimos.*');
        if (Input::has('turmas')) {
            $emprestimos = $emprestimos->whereIn('turma_id', Input::get('turmas', []));
        }

        if (Input::has('alunos')) {
            $emprestimos = $emprestimos->whereIn('aluno_id', Input::get('alunos', []));
        }

        if (Input::has('livros')) {
            $emprestimos = $emprestimos->whereIn('exemplares.livro_id', Input::get('livros', []));
        }
        $emprestimosInativos = Input::input('emprestimosInativos', false);
        if ($emprestimosInativos) {
            $emprestimos = $emprestimos->withTrashed()->orderBy('deleted_at', 'ASC');
        }
        $emprestimos = $emprestimos->get();
        $turmas = Turma::orderBy('curso_id')->orderBy('nome')->get();
        $livros = Livro::all();
        $alunos = Aluno::all();
        Input::flash();
        return view('relatorio.index', compact(['emprestimos', 'turmas', 'livros', 'alunos', 'emprestimosInativos']))->withInput([0]);
    }
}
