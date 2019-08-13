<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exemplar;

class BarcodeController extends Controller
{
    public function index() {
        return view('barcode.index');
    }


    public function criar($codigo_banco){
        $divisao_unitaria = str_split($codigo_banco);
        
        $soma = array_sum($divisao_unitaria);
        $validacao = $soma % 9;
        
        return $codigo_banco.'-'.$validacao;        
    }

    public function valida($codigo){
        $codigo = explode('-', $codigo);

        $divisao_unitaria = str_split($codigo[0]);
            
        $soma = array_sum($divisao_unitaria);

        if($soma % 9 == $divisao_unitaria[1]){
            return True;
        }
        else{
            return False; 
        }           
    }

    public function store(Request $request) {

        $codes = [];
        $quantidade = $request->input('quantidade', 0);
        // TODO: Regra para criar um codigo de barras com validação
        $lastCode = Exemplar::orderBy('code', 'desc')->first();
            if($lastCode != null){
                $lastCode = explode('-', $lastCode->code)[0];
        } else {
            $lastCode = 10000;
        }

        // TODO: Não criar exemplares para cada codigo gerado. Criar aqui apenas os codigos auto validados e na hora de registrar os livros criar os exemplares com os codigos
        for ($x=0; $x < $quantidade; $x++) { 
            $exemplar = new Exemplar();
            $lastCode++;
            $exemplar->code = $this->criar($lastCode); ;
            $exemplar->user_id = auth()->user()->id;
            $exemplar->save();
            $codes[] = $exemplar->code;
        }
        
        return view('barcode.index', compact('codes'));

    }
}
