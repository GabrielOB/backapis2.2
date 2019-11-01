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
        // $usuario = Auth::user();

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
            'id_cliente' => Auth::user()->id,
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
        $contrato->update([
            'hora' => isset($resquest->hora) ? $resquest->hora : $contrato->hora,
            'data' => isset($resquest->data) ? $resquest->data : $contrato->data,
            'valor' => isset($resquest->valor) ? $resquest->valor : $contrato->valor,
            'descricao' => isset($resquest->descricao) ? $resquest->descricao : $contrato->descricao,
            'status' => isset($resquest->status) ? $resquest->status : $contrato->status,
            'conf_pre' => isset($resquest->conf_pre) ? $resquest->conf_pre : $contrato->conf_pre,
            'conf_cli' => isset($resquest->conf_cli) ? $resquest->conf_cli : $contrato->conf_cli
        ]);
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
        return response()->json(Contrato::where('id_cliente', '=', Auth::user()->id)->get());
    }
}
