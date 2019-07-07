<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Livro extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'isbn', 'nome', 'volume', 'autor', 'urlFoto', 'categoria_id', 'user_id'
    ];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }

    public function exemplares(){
        return $this->hasMany('App\Exemplar');
    }
}
