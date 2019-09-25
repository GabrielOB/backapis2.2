<?php

namespace App\Http\Controllers;

use App\Comentario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ComentarioController extends Controller
{
    protected $jwt;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function cadastrarComentario(Request $resquest){
        $usuario = Auth::user();

        $this->validate($resquest, [
            'prestador_id',
            'comentario'
        ]);

        $comentario = new Comentario;
        $comentario->prestador_id = $resquest->prestador_id;
        $comentario->cliente_id = $usuario->id;
        $comentario->comentario = $resquest->comentario;

        $comentario->save();
        return response()->json($comentario);

    }
}
