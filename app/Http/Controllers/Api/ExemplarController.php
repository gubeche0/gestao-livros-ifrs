<?php

namespace App\Http\Controllers\Api;

use App\Exemplar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        // return $exemplar->loadMissing('livro');
        $exemplar = Exemplar::find($exemplar);
        
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
    public function update(Request $request, Exemplar $exemplar)
    {
        //
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
