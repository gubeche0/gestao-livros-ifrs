<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Exemplar extends Model
{
    use softDeletes;
    
    protected $fillable = ['livro_id', 'user_id', 'status'];
    protected $dates = ['deleted_at'];
    protected $table = 'exemplares';
    protected $primaryKey = 'code';
    public $incrementing = false;

    public function livro(){
        return $this->belongsTo('App\Livro');
    }

    public function emprestimos(){
        return $this->hasMany('App\Emprestimo');
    }

    public function emprestado(){
        return ($this->emprestimos->count() >= 1) ? true : false;
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
}
