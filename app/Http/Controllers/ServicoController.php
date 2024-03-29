<?php

namespace App\Http\Controllers;

use App\Servico;
use App\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ServicoController extends Controller
{

    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function mostrarTodosServicos(){
        return response()->json(Servico::all());
    }

    public function cadastrarServico(Request $request){
        $user = Auth::user();
        
        //Validação
        $this->validate($request, [
            'nome' => 'required|min:5|max:100',
            'valorBase' => 'required'
        ]);

        // Inserindo e salvando
        $servico = Servico::create([
            'nome' => $request->nome,
            'valorBase' => $request->valorBase
        ]);
        
        // Vincular serviço ao usuario;
        $servico->usuarios()->attach($user);

        return response()->json($servico);
    }

    public function vincularServico(Request $request){
        $user = Auth::user();
        $servico = Servico::find($request->servico_id);
        $servico->usuarios()->attach($user);
        return response()->json('Serviço vinculado com sucesso');
    }

    
    public function mostrarServico($id){
        $usuario = Usuario::find($id);
        return response()->json($usuario->servicos()->get());    }

    public function atualizarServico($id, Request $request){
        // validando
        $this->validate($request, [
            'nome',
            'valorBase'
        ]);
        
        // Atualizando
        $servico = Servico::find($id)->update([
            'nome' => $request->nome,
            'valorBase' => $request->valorBase
        ]);

        return response()->json(['msg' => 'Serviço atualizado com sucesso.']);
    }
    //

    public function deletarServico($id){
        Servico::find($id)->delete();
        return response()->json(['msg' => 'Deletado com sucesso'], 200);
    }

}

