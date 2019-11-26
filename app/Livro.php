<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Livro extends Model
{
    use softDeletes;
    
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'isbn', 'titulo', 'volume', 'autor', 'urlFoto',
    ];

    public function exemplares(){
        return $this->hasMany('App\Exemplar');
    }

    public function estoque(){
        return $this->exemplares()->count();
    }

    public function disponiveis(){
        return $this->estoque() - $this->exemplares()->whereHas('emprestimos')->get()->count();
    }
}
