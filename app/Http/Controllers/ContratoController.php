<?php

namespace App\Http\Controllers;

use App\Contrato;
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

    public function cadastrarContrato(Request $resquest){
        // $usuario = Auth::user();

        $this->validate($resquest, [
            'id_prestador',
            'id_servico',
            'hora',
            'data',
            'valor',
            'descricao',
            'status',
            'conf_cliente',
            'conf_prestador'
        ]);

        $contrato = Contrato::create([
            'id_prestador' => $resquest->id_prestador,
            'id_cliente' => Auth::user()->id,
            'id_servico' => $resquest->id_service,
            'hora' => $resquest->hora,
            'data' => $resquest->data,
            'valor' => $resquest->valor,
            'descricao' => $resquest->descricao,
            'status' => $resquest->status,
            'conf_prestador' => $resquest->conf_prestador,
            'conf_cliente' => $resquest->conf_cliente
        ]);
        return response()->json($contrato);

    }

    public function atualizarContrato($id, Request $resquest){
        $this->validate($resquest, [
            'hora',
            'data',
            'valor',
            'descricao',
            'status',
            'conf_cliente',
            'conf_prestador'
        ]);

        $comentario = Comentario::find($id)->update([
            'id_prestador' => $resquest->id_prestador,
            'id_cliente' => Auth::user()->id,
            'id_servico' => $resquest->id_service,
            'hora' => $resquest->hora,
            'data' => $resquest->data,
            'valor' => $resquest->valor,
            'descricao' => $resquest->descricao,
            'status' => $resquest->status,
            'conf_prestador' => $resquest->conf_prestador,
            'conf_cliente' => $resquest->conf_cliente
        ]);
        return response()->json($comentario);
    }

    public function deletarContrato($id, Request $resquest){
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
