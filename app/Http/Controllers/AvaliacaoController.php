<?php

namespace App\Http\Controllers;

use App\Avaliacao;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;

class AvaliacaoController extends Controller
{

    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function store(Request $request){
        $user = Auth::user();

        $this->validate($request, [
            'nota' => 'required|min:1|max:5',
            'conteudo' => 'required',
            'id_prestador' => 'required',
        ]);

        $avaliacao = Avaliacao::create([
            'nota' => $request->nota,
            'conteudo' => $request->conteudo,
            'id_prestador' => $request->id_prestador,
            'id_cliente' => $user->id
        ]);

        return response()->json($avaliacao);
    }

    public function index(){
        $avaliacoes = Avaliacao::all();
        return response()->json($avaliacoes);
    }

    public function show($id_prestador){
        $avaliacoes = Avaliacao::where('id_prestador', $id_prestador)->get();
        return response()->json($avaliacoes);
    }


    public function delete($id_avaliacao){
        Avaliacao::find($id_avaliacao)->delete();
        return response()->json(['msg' => 'Deletado com sucesso'], 204);
    }

}

