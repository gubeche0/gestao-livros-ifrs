<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Turma;
use App\Curso;
use App\Http\Requests\TurmaRequest;

class TurmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $turmas = Turma::orderBy('deleted_at', 'asc')->orderBy('ano', 'DESC')->orderBy('curso_id')->orderBy('nome')->withTrashed()->get();
        return view('turma.index', compact('turmas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::all();
        $ano = date('Y');
        return view('turma.form', compact('cursos', 'ano'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TurmaRequest $request)
    {
        $turma = new Turma([
            'nome' => $request->input('nome'),
            'curso_id' => $request->input('curso'),
            'ano' => date('Y')
        ]);

        $turma->save();
        return redirect()->route('turma.index')->
            with('success', ['Turma cadastrado com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Turma $turma)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Turma $turma)
    {
        $cursos = Curso::all();
        $ano = date('Y');
        return view('turma.form', compact('turma', 'cursos', 'ano'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TurmaRequest $request, Turma $turma)
    {
        $turma->nome = $request->input('nome');
        // $turma->curso_id = $request->input('curso');
        $turma->save();
        return redirect()->route('turma.index')->
            with('success', ['Turma alterada com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Turma $turma)
    {
        $turma->delete();
        return redirect()->route('turma.index')->
            with('success', ['Turma deletada com sucesso!']);
    }

    public function restore($id)
    {
        $turma = Turma::onlyTrashed()->findOrFail($id);
        $turma->restore();
        return redirect()->route('turma.index')->
            with('success', ['Turma restaurada com sucesso!']);
    }
}
