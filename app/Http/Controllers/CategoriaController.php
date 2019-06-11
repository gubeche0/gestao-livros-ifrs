<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;

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


    public function store(Request $request)
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


    public function update(Request $request, Categoria $categoria)
    {
        $categoria->nome = $request->input('nome');
        $categoria->save();
        return redirect()->route('categoria.index')->
            with('success', ['Categoria alterada com sucesso!']);
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->destroy();
        return redirect()->route('categoria.index')->
            with('success', ['Categoria deletada com sucesso!']);
    }
}
