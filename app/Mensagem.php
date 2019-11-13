<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensagem extends Model
{
    protected $fillable = [
        'provider', 'content', 'read'
    ];

    public function chat(){
        return $this->belongsTo('App\Chat', 'id_chat');
    }


}
