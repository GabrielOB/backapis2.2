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

        $comentario = Comentario::create([
            'prestador_id' => $resquest->prestador_id,
            'cliente_id' => $usuario->id,
            'comentario' => $resquest->comentario,
        ]);
        /* $comentario->prestador_id = $resquest->prestador_id;
        $comentario->cliente_id = $usuario->id;
        $comentario->comentario = $resquest->comentario; */

        // $comentario->save();
        return response()->json($comentario);

    }

    public function atualizarComentario($id, Request $resquest){
        $this->validate($resquest, [
            'comentario'
        ]);

        $comentario = Comentario::find($id)->update([
            'comentario' => $resquest->comentario
        ]);
        return response()->json($comentario);
    }

    public function deletarComentario($id, Request $resquest){
        Comentario::find($id)->delete();
        return response()->json(['msg' => 'Deletado com sucesso'], 200);
    }

    public function showOne($id_comentario, Request $resquest){
        $comentario = Comentario::find($id_comentario);
        return response()->json($comentario);
    }

    public function showAll(){
        return response()->json(Comentario::all());

    }
}
