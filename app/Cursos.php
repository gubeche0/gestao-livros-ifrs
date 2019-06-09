<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cursos extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
}
