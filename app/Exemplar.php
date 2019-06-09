<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Exemplar extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
    protected $table = 'exemplares';
}
