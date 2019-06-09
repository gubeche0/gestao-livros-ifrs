<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
}
