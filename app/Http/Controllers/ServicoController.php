<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ServicoController extends Controller
{

    public function mostrarTodosServicos(){
        return response()->json(Servico::all());
    }

    public function cadastrarServico(Request $request){
        
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

        return response()->json($usuario);
    }

    public function mostrarServico($id){
        return response()->json(Servico::find($id));
    }

    public function atualizarServico($id, Request $request){
        // validando
        $this->validate($request, [
            'nome',
            'valorBase'
        ]);
        
        // Atualizando
        $servico = Servico::find($id)->update([
            'nome',
            'valorBase'
        ]);

        return response()->json($usuario);
    }
    //

    public function deletarServico($id){
        $servico = Servico::find($id);
        $servico->delete();
        return response()->json('Deletado com sucesso', 200);
    }

}
