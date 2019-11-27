<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisicaoLivro extends Model
{
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'titulo', 'volume', 'autor', 'observacao', 'area_id', 'assunto_id', 'user_id'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function area(){
        return $this->belongsTo('App\Area');
    }

    public function assunto(){
        return $this->belongsTo('App\Assunto');
    }

}
