<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Mensagem;
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
            'provider' => 'required|nullable'
        ]);

        $chat = Chat::create([
            'id_provider' => $request->id_provider,
            'id_client' => $request->id_client,
            'provider' => $request->provider
        ]);

        return response()->json($chat);

    }
}

