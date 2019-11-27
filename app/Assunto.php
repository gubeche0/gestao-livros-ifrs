<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assunto extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

}
