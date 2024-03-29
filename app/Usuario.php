<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'usuario', 'email', 'cpf', 'endereco', 'telefone', 'prestador'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims(){
        return [];
    }

    public function servicos()
    {
        return $this->belongsToMany('App\Servico', 'usuario_servico');
    }

    public function avaliacoes(){
        return $this->hasMany('App\Avaliacao');
    }

    public function providerChats(){
        return $this->hasMany('App\Chat', 'id_provider');
    }

    public function clientChats(){
        return $this->hasMany('App\Chat', 'id_client');
    }

}

