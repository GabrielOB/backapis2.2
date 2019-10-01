<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
   protected $fillable = [
        'id', 'id_prestador', 'id_cliente', 'id_servico', 'hora', 'data', 'valor', 'descricao', 'status', 'conf_pre', 'conf_cli'
   ];

   protected $casts = [
       'id_prestador' => 'integer',
       'id_cliente' => 'integer',
       'id_servico' => 'integer'
   ];
}
