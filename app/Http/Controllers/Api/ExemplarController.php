<?php

namespace App\Http\Controllers\Api;

use App\Exemplar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Livro;

class ExemplarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Exemplar::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Exemplar  $exemplar
     * @return \Illuminate\Http\Response
     */
    public function show($exemplar)
    {
        $exemplar = Exemplar::whereNotNull('livro_id')->find($exemplar);
        
        if($exemplar){
            return [
                'status' => true,
                'exemplar' => $exemplar->load(['livro', 'emprestimos.aluno']),
                'emprestado' => $exemplar->emprestado()
            ];
        }
        return [
            'status' => false
        ];

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exemplar  $exemplar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $exemplar)
    {
        $exemplar = Exemplar::find($exemplar);
        if(!$exemplar){
            return [
                'status' => false,
                'error' => 'Exemplar não cadastrado!'
            ];
        }
        if($request->has('livro')){
            if($exemplar->livro){
                return [
                    'status' => false,
                    'error' => 'Exemplar já registrado!'
                ];
            }

            $livro = Livro::find($request->input('livro'));
            if(!$livro){
                return [
                    'status' => false,
                    'error' => 'Livro não cadastrado!'
                ];
            }
            $exemplar->livro()->associate($livro);
        }

        $exemplar->save();
        return [
            'status' => true,
            'exemplar' => $exemplar
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Exemplar  $exemplar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exemplar $exemplar)
    {
        //
    }
}
