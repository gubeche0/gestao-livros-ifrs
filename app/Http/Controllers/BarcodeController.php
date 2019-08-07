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
    	$somatorio=0;

    
        $divisao_unitaria = str_split($codigo_banco);
        
        for ($i=0; $i < 5; $i++) { 
            $somatorio += $divisao_unitaria[$i];
        }

        $validacao = $somatorio % 9;
        
        $codigo_validacao = $codigo_banco.'-'.$validacao;
        
        
        return $codigo_validacao;
                
        
    }

    public function valida($codigo){

        $somatorio=0;    
            
        $divisao_unitaria = str_split($codigo);
            
        for ($i=0; $i < 5; $i++) { 
            $somatorio += $divisao_unitaria[$i];
        }
        echo $somatorio % 9;
        echo $divisao_unitaria[5]; 
        if($somatorio % 9 == $divisao_unitaria[6]){
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
                $lastCode = $lastCode->code;
                $certo = null;
                $certo = str_split($lastCode);
                $lastCode= null;
                for ($i=0; $i < 5; $i++) { 
                    $lastCode .= $certo[$i];
                }

        } else {
            
            $lastCode = 10000;
        }

        // TODO: Não criar exemplares para cada codigo gerado. Criar aqui apenas os codigos auto validados e na hora de registrar os livros criar os exemplares com os codigos
        for ($x=0; $x < $quantidade; $x++) { 
            $exemplar = new Exemplar();
            ++$lastCode;
            $exemplar->code = $this->criar($lastCode); ;
            $exemplar->user_id = auth()->user()->id;
            $exemplar->save();
            $codes[] = $exemplar->code;
        }
        
        return view('barcode.index', compact('codes'));

    }
}
