<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
}
