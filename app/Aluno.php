<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Aluno extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];

    protected $fillable = ['matricula','nome', 'email', 'curso', 'curso_id'];
    
    public function curso(){
        return $this->belongsTo('App\Curso');
    }
}
