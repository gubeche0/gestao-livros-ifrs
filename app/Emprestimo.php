<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
}
