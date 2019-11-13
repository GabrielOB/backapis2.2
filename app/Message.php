<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'provider', 'content', 'read'
    ];

    protected $table = 'message';

    public function chat(){
        return $this->belongsTo('App\Chat', 'id_chat');
    }


}
