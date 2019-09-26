<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
   protected $fillable = [
        'id', 'prestador_id', 'cliente_id', 'comentario'
   ];

   protected $casts = [
       'prestador_id' => 'integer',
       'cliente_id' => 'integer'
   ];
}
