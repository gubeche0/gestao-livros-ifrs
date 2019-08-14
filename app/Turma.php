<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Turma extends Model
{
    use SoftDeletes;
    protected $fillable = ['nome', 'curso_id', 'ano'];

    public function curso(){    
        return $this->belongsTo('App\Curso');
    }
}
