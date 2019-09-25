<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Curso extends Model
{
    use SoftDeletes;
    protected $fillable = ['id', 'nome', 'abreviacao'];

    protected $dates = ['deleted_at'];

    public function turmas(){
        return $this->hasMany('App\Turma');
    }

    public function alunos(){
        return $this->hasMany('App\Aluno');
    }
}
