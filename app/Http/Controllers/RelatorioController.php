<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Emprestimo;
use App\Turma;
use App\Livro;
use App\Aluno;
use App\Curso;
use Illuminate\Support\Facades\Input;


class RelatorioController extends Controller
{
    public function emprestimo()
    {
        $emprestimos = Emprestimo::join('exemplares', 'exemplares.code', '=', 'emprestimos.exemplar_code')->join('alunos', 'alunos.id', '=', 'emprestimos.aluno_id')->select('exemplares.livro_id', 'emprestimos.*');
        if (Input::has('cursos')) {
            $emprestimos = $emprestimos->whereIn('curso_id', Input::get('cursos', []));
        }

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
        $cursos = Curso::all();
        Input::flash();
        return view('relatorio.emprestimo', compact(['emprestimos', 'cursos', 'turmas', 'livros', 'alunos', 'emprestimosInativos']))->withInput([0]);
    }
}
