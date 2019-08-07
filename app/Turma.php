<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['nome', 'curso_id', 'ano'];

    public function curso(){    
        return $this->belongsTo('App\Curso');
    }
}
