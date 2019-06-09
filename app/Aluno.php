<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Aluno extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];

    public function curso(){
        return $this->belongsTo('App\Curso');
    }
}
