<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;

class ChatUserController extends Controller{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function index(){
        $user = Auth::user();

        if($user->prestador){
            $chats = Chat::with('client:id,usuario')->where('id_provider', $user->id)->get();
        }else{
            $chats = Chat::with('provider:id,usuario')->where('id_client', $user->id)->get();
        }

        if(!count($chats)){
            return response()->json([
                'error' => 'No chats found'
            ], 204);
        }
        return response()->json($chats);
    }
}

