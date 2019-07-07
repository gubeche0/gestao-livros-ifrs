<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaRequest;

class CategoriaController extends Controller
{

    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }


    public function create()
    {
        return view('categoria.form');
    }


    public function store(CategoriaRequest $request)
    {
        $categoria = new Categoria();
        $categoria->nome = $request->input('nome');
        $categoria->user_id = auth()->user()->id;
        $categoria->save();
        return redirect()->route('categoria.index')->
            with('success', ['Categoria(a) cadastrado(a) com sucesso!']);
    }


    public function show($id)
    {
        //
    }

    public function edit(Categoria $categoria)
    {
        return view('categoria.form', compact('categoria'));
    }


    public function update(CategoriaRequest $request, Categoria $categoria)
    {
        $categoria->nome = $request->input('nome');
        $categoria->save();
        return redirect()->route('categoria.index')->
            with('success', ['Categoria alterada com sucesso!']);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categoria.index')->
            with('success', ['Categoria deletada com sucesso!']);
    }
}
