<?php

namespace App\Http\Controllers;

use App\Prestador;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;

class PrestadorController extends Controller
{
    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
        $this->middleware('auth:api');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required|max:500',
            'nota' => 'nullable|min:1|max:5'
        ]);

        $prestador = Prestador::create([
            'id_usuario' => Auth::user()->id,
            'descricao' => $request->descricao
        ]);

        return response()->json($prestador);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'descricao' => 'required|max:500'
        ]);

        $prestador = Prestador::where('id_usuario', Auth::user()->id);
        $prestador->update([
            'descricao' => $request->descricao
        ]);

        return response()->json($prestador->get());
    }

    public function show()
    {
        return response()->json(Prestador::where('id_usuario', Auth::user()->id)->get());
    }

    public function delete(){
        Prestador::where('id_usuario', Auth::user()->id)->delete();
        return response()->json(['msg' => 'Apagado com sucesso']);
    }
}
