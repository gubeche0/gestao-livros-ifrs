<?php

namespace App\Http\Controllers;

use App\Area;
use App\Assunto;
use App\RequisicaoLivro;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;


class RequisicaoLivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = RequisicaoLivro::select();

        if (Input::has('areas')) {
            $livros = $livros->whereIn('area_id', Input::get('areas', []));
        }

        if (Input::has('assuntos')) {
            $livros = $livros->whereIn('assunto_id', Input::get('assuntos', []));
        }

        if (Input::has('professores')) {
            $livros = $livros->whereIn('user_id', Input::get('professores', []));
        }

        if (Input::has('livro')) {
            $livros = $livros->where('titulo', 'like', '%' . Input::get('livro', '') . '%');
        }


        $livros = $livros->get();

        $areas = Area::all();
        $assuntos = Assunto::all();
        $professores = User::where('tipo', '=', User::PROFESSOR)->get();

        Input::flash();
        return view('requisicaoLivro.index')->with(compact(['livros', 'areas', 'assuntos', 'professores']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $areas = Area::all();
        $assuntos = Assunto::all();
        return view('requisicaoLivro.form')->with(compact(['areas', 'assuntos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requisicao = new RequisicaoLivro([
            'titulo' => $request->input('titulo'),
            'volume' => $request->input('volume'),
            'autor' => $request->input('autor'),
            'area_id' => $request->input('area'),
            'assunto_id' => $request->input('assunto'),
            'user_id' => auth()->user()->id
        ]);
        $requisicao->save();

        return redirect()->route('requisicaoLivro.index')->
            with('success', ['Requisição cadastrada com sucesso!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
