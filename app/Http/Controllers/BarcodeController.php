<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exemplar;

class BarcodeController extends Controller
{
    public function index() {
        return view('barcode.index');
    }

    public function store(Request $request) {

        $codes = [];
        $quantidade = $request->input('quantidade', 0);
        // TODO: Regra para criar um codigo de barras com validação
        $lastCode = Exemplar::orderBy('code', 'desc')->first();
        if($lastCode){
            $lastCode = $lastCode->code;
        } else {
            $lastCode = 10000;
        }

        // TODO: Não criar exemplares para cada codigo gerado. Criar aqui apenas os codigos auto validados e na hora de registrar os livros criar os exemplares com os codigos
        for ($x=0; $x < $quantidade; $x++) { 
            $exemplar = new Exemplar();
            $exemplar->code = ++$lastCode;
            $exemplar->user_id = auth()->user()->id;
            $exemplar->save();
            $codes[] = $exemplar->code;
        }
        
        return view('barcode.index', compact('codes'));

    }
}
