<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Emprestimo extends Model
{
    use softDeletes;
    protected $fillable = ['exemplar_code', 'aluno_id', 'turma_id','curso_id'];

    protected $dates = ['deleted_at'];

    public function exemplar(){
        return $this->belongsTo('App\Exemplar');
    }

    public function aluno(){
        return $this->belongsTo('App\Aluno');
    }

    public function turma(){
        return $this->belongsTo('App\Turma');
    }

    
}
