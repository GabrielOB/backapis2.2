<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
   protected $fillable = [
        'id', 'id_prestador', 'id_cliente', 'nota', 'conteudo'
   ];

}
