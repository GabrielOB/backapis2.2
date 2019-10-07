<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use App\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AvaliacaoController extends Controller
{

    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function cadastrarAvaliacao($id, Request $request){
        $user = Auth::user();
        
        //Validação
        $this->validate($request, [
            'nota' => 'required|min:1|max:5',
            'conteudo' => 'required',
            // 'id_prestador' => 'required'
        ]);

        // Inserindo e salvando
        $avaliacao = Avaliacao::create([
            'nota' => $request->nota,
            'conteudo' => $request->conteudo,
            'id_prestador' => $id,
            'id_cliente' => $user->id
        ]);
        
        return response()->json($avaliacao);
    }
    
    public function mostrarAvaliacao($id, Request $request){
        $usuario = Auth::user();
        $arrayAvaliacao = array();
        $prestador = Usuario::find($id)->avalicoes;
        foreach ($prestador->avaliacoes as $avaliacao) {
            // unset($servico['pivot']);
            // unset($servico['created_at']);
            // unset($servico['updated_at']);
            $arrayAvaliacao[] = $avaliacao;
        }
        return response()->json($arrayAvaliacao);
    }


    /* Atualmente atualizar esta baseada  em serviço, caso precise ser implementada mudar nome e logica */

    // public function atualizarServico($id, Request $request){
    //     // validando
    //     $this->validate($request, [
    //         'nome',
    //         'valorBase'
    //     ]);
        
    //     // Atualizando
    //     $servico = Servico::find($id)->update([
    //         'nome' => $request->nome,
    //         'valorBase' => $request->valorBase
    //     ]);

    //     return response()->json(['msg' => 'Serviço atualizado com sucesso.']);
    // }


    public function deletarAvaliacao($id_comentario){
        Avaliacao::find($id_comentario)->delete();
        return response()->json(['msg' => 'Deletado com sucesso'], 200);
    }

}

