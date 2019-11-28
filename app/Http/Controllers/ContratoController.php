<?php

namespace App\Http\Controllers;

use App\Contrato;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ContratoController extends Controller
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

    public function store(Request $resquest){
        $usuario = Auth::user();

        if($usuario->prestador){
            return response()->json(['error' => 'Prestadores não podem criar contratos'], 400);
        }

        $this->validate($resquest, [
            'id_prestador',
            'id_servico',
            'hora',
            'data',
            'valor',
            'descricao',
        ]);

        $contrato = Contrato::create([
            'id_prestador' => $resquest->id_prestador,
            'id_cliente' => $usuario->id,
            'id_servico' => $resquest->id_servico,
            'hora' => $resquest->hora,
            'data' => $resquest->data,
            'valor' => $resquest->valor,
            'descricao' => $resquest->descricao
        ]);

        return response()->json($contrato);

    }

    public function update($id_contrato, Request $resquest){
        $this->validate($resquest, [
            'hora' => 'nullable',
            'data' => 'nullable',
            'valor' => 'nullable',
            'descricao' => 'nullable',
            'status' => 'nullable',
            'conf_cli' => 'nullable',
            'conf_pre' => 'nullable'
        ]);

        $contrato = Contrato::find($id_contrato);
        $contrato->fill($resquest->input())->save();
        return response()->json($contrato);
    }

    public function delete($id_contrato){
        Contrato::find($id_contrato)->delete();
        return response()->json(['msg' => 'Deletado com sucesso'], 200);
    }

    public function show($id_contrato){
        $contrato = Contrato::find($id_contrato);
        return response()->json($contrato);
    }

    public function index(){
        $user = Auth::user();
        if($user->prestador){
            $contratos = Contrato::where('id_prestador', '=', $user->id)->get();
        }else{
            $contratos = Contrato::where('id_cliente', '=', $user->id)->get();
        }
        return response()->json($contratos);
    }
}
