<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
}
