<?php

namespace App\Http\Controllers;

use App\Usuario;
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

    public function index(){
        $chats = Chat::all();
        return response()->json($chats);
    }

    public function show($id_chat){
        $chat = Chat::find($id_chat);
        return response()->json($chat);
    }

    public function store(Request $request){
        $this->validate($request, [
            'id_provider' => 'required',
            'id_client' => 'required',
        ]);

        $provider = Usuario::find($request->id_provider);
        if(!$provider){
            return response()->json([
                'error' => 'Provider not found'
            ], 400);
        }else if(!$provider->prestador){
            return response()->json([
                'error' => 'User is not a provider'
            ], 400);
        }

        $client = Usuario::find($request->id_client);
        if(!$client){
            return response()->json([
                'error' => 'Client not found'
            ], 400);
        }

        $chat = Chat::create([
            'id_provider' => $request->id_provider,
            'id_client' => $request->id_client
        ]);

        return response()->json($chat, 201);

    }
}

