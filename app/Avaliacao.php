<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
   protected $fillable = [
        'id', 'prestador_id', 'cliente_id', 'nota', 'conteudo'
   ];

}
