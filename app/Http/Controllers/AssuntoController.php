<?php

namespace App\Http\Controllers;

use App\Assunto;
use App\Http\Requests\AssuntoRequest;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class AssuntoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assuntos = Assunto::all();
        return view('assunto.index', compact('assuntos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('assunto.form');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AssuntoRequest $request)
    {
        $assunto = new Assunto();
        $assunto->nome = $request->input('nome');
        $assunto->save();
        return redirect()->route('assunto.create')->
            with('success', ['Assunto cadastrado com sucesso!']);
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
    public function edit(Assunto $assunto)
    {
        return view('assunto.form', compact('assunto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AssuntoRequest $request, Assunto $assunto)
    {
        $assunto->nome = $request->input('nome');
        $assunto->save();
        return redirect()->route('assunto.index')->
            with('success', ['Assunto alterado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assunto $assunto)
    {
        $assunto->delete();
        return redirect()->route('assunto.index')->
            with('success', ['Assunto deletado com sucesso!']);
    }
}
