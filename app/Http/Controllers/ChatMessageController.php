<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Message;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;


class ChatMessageController extends Controller{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function index($id_chat){
        $chat = Chat::find($id_chat);

        if(!$chat){
            return response()->json([
                'error' => 'Chat not found'
            ], 404);
        }

        $messages = $chat->messages()->orderBy('created_at', 'DESC')->get();

        return response()->json($messages);
    }

    public function store($id_chat, Request $request){
        $user = Auth::user();

        $this->validate($request, [
            'content' => 'required',
        ]);

        $chat = Chat::find($id_chat);

        $message = $chat->messages()->create([
            'provider' => $user->prestador,
            'content' => $request->content
        ]);

        $chat->update([
            'last_message' => $message->content
        ]);

        return response()->json($message, 201);
    }
}

