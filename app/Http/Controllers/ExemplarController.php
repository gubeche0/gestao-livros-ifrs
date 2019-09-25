<?php

namespace App\Http\Controllers;

use App\Emprestimo;
use App\Livro;
use App\Exemplar;
use Illuminate\Http\Request;
use App\Http\Requests\ExemplarRequest;

class ExemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Livro $livro)
    // {
    //     $livroTitulo = $livro->titulo;
    //     $exemplares = Exemplar::where('livro_id', $livro->id)->withTrashed()->get();

    //     return view('exemplares.index', compact('exemplares', 'livroTitulo'));
    // }

    /**
     * Show the form for register a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExemplarRequest $request)
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emprestimos = Emprestimo::where('exemplar_code', $id)
        ->orderBy('deleted_at')
        ->withTrashed()
        ->get();
        return view('exemplares.info', compact('emprestimos', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExemplarRequest $request, Exemplar $exemplar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exemplar $exemplar)
    {
        $livro = $exemplar->livro_id;
        $exemplar->delete();
        return redirect()->route('livro.exemplar', [$livro])->
            with('success', ['Exemplar deletado com sucesso!']);
    }

    public function restore($exemplar)
    {
        $exemplar = Exemplar::onlyTrashed()->where('code', $exemplar)->first();
        $livro = $exemplar->livro_id;
        $exemplar->restore();
        return redirect()->route('livro.exemplar', [$livro])->
            with('success', ['Exemplar restaurado com sucesso!']);
    }
}