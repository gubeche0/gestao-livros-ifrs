<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $exemplares = Exemplar::all();
        return view('exemplares.index', compact('exemplares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $livros = Livro::all();
        return view('exemplares.form', compact('livros'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExemplarRequest $request)
    {

        $coders = [];
        $quantidade = $request->input('quantidade', 0);

        for ($x=0; $x < $quantidade; $x++) { 
            $exemplar = new Exemplar();
            $exemplar->livro()->associate($request->input('livro'));
            $exemplar->user_id = auth()->user()->id;
            $exemplar->save();
            $coders[] = $exemplar->id;
        }

        $livros = Livro::all();
        
        return view('exemplares.form', compact('livros', 'coders'));
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
    public function edit(Exemplar $exemplar)
    {
        $livros = Livro::all();
        return view('exemplares.form', compact('livros', 'exemplar'));
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
        $exemplar->livro()->associate($request->input('livro'));
        $exemplar->save();
        return redirect()->route('exemplar.index')->
            with('success', ['Exemplar alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exemplar $exemplar)
    {
        $exemplar->delete();
        return redirect()->route('exemplar.index')->
            with('success', ['Exemplar deletado com sucesso!']);
    }
}
