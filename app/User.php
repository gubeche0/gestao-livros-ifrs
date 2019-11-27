<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const COORDENADORIA = 1;
    const ADMINISTRADOR = 2;
    const COORDENADOR= 3;
    const PROFESSOR= 4;
    // const CAE = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'login', 'tipo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isTipo(...$tipos) {
        if (in_array($this->tipo, $tipos)) {
            return true;
        }
        return false;
    }


    public function isCoord() {
        return ($this->tipo == 1) ? true : false;
    }
    
    public function isAdmin() {
        return ($this->tipo == 2) ? true : false;
    }
}
