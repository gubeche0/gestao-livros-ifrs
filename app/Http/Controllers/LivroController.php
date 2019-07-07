<?php

namespace App\Http\Controllers;

use App\Livro;
use App\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\LivroRequest;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livros = Livro::all();
        return view('livro.index', compact('livros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('livro.form', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivroRequest $request)
    {
        Livro::create([
            'isbn' => $request['isbn'], 
            'nome' => $request['nome'], 
            'volume' => $request['volume'], 
            'autor' => $request['autor'], 
            'categoria_id' => $request['categoria'], 
            'user_id' => auth()->user()->id,    
            'urlFoto' => $request['foto']->getClientOriginalName(),
        ]);

        Storage::disk('public')->putFileAs('fotoLivro' ,$request['foto'], $request['foto']->getClientOriginalName());
        
        return redirect()->route('livro.index')->
            with('success', ['Livro cadastrado com sucesso!']);
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
    public function edit(Livro $livro)
    {
        $categorias = Categoria::all();
        return view('livro.form', compact(['livro', 'categorias']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Livro $livro)
    {
        $livro->fill($request->all());
        $livro->categoria()->associate(Categoria::findOrFail($request->input('categoria')));
        $livro->save();
        return redirect()->route('livro.index')->
            with('success', ['Livro atualizado com sucesso!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Livro $livro)
    {
        $livro->delete();
        return redirect()->route('livro.index')->
            with('success', ['Livro deletado com sucesso!']);
    }
}
