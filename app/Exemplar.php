<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exemplar extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
    protected $table = 'exemplares';
}
