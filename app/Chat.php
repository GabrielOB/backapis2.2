<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'id_client', 'id_provider'
    ];

    /* protected $casts = [
        'id_usuario' => 'integer',
        'nota' => 'float',
        'tipo' => 'integer'
    ]; */
}
