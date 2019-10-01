<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestador extends Model
{
    protected $fillable = [
        'id_usuario', 'descricao', 'nota'
    ];

    protected $casts = [
        'id_usuario' => 'integer',
        'nota' => 'float',
        'tipo' => 'integer'
    ];
}
