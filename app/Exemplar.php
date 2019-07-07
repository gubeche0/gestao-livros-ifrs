<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Exemplar extends Model
{
    use softDeletes;
    
    protected $fillable = ['livro_id', 'user_id', 'status'];
    protected $dates = ['deleted_at'];
    protected $table = 'exemplares';

    public function livro(){
        return $this->belongsTo('App\Livro');
    }

    public function emprestimos(){
        return $this->hasMany('App\Emprestimo');
    }

    public function emprestado(){
        return ($this->emprestimos->count() >= 1) ? true : false;
    }
    
}
