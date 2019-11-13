<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_provider' => 'required',
            'id_client' => 'required',
        ]);
    }
}

