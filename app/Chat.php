<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'id_provider', 'id_client','last_message'
    ];

    protected $table = 'chat';

    public function messages(){
        return $this->hasMany('App\Message', 'id_chat');
    }

}
