<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
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
        $this->middleware('auth:api',[
            'except' => ['usuarioLogin', 'cadastrarUsuario']
        ]);
    }

    public function usuarioLogin(Request $request){
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(! $token = $this->jwt->claims(['email' => $request->get("email")])->attempt($request->only('email', 'password'))){
            return response()->json(['Usuario não encontrado'], 404);
        }

        return response()->json(compact('token'));
    }

    public function mostrarUsuarioAutenticado(){
        $usuario = Auth::user();

        return response()->json($usuario);
    }

    public function mostrarTodosUsuarios(){
        return response()->json(Usuario::all());
    }

    public function cadastrarUsuario(Request $request){
        //Validação
        $request->validate([
            'usuario' => 'required|min:5|max:40',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required',
            'cpf' => 'required',
            'endereco' => 'required',
            'telefone' => 'required'
        ]);


        //Inserindo usuário
        $usuario = new Usuario;
        $usuario->email = $request->get("email");
        $usuario->usuario = $request->usuario;
        $usuario->password = Hash::make($request->password);
        $usuario->cpf = $request->cpf;
        $usuario->telefone = $request->telefone;
        $usuario->endereco = $request->endereco;

        //Salvar registro no banco
        $usuario->save();
        return response()->json($usuario);
    }

    public function mostrarUsuario($id){
        return response()->json(Usuario::find($id));
    }

    public function atualizarUsuario($id, Request $request){
        $usuario = Usuario::find($id);

        $usuario->email = $request->email;
        $usuario->usuario = $request->usuario;
        $usuario->password = $request->password;

        //Utilizar save
        $usuario->save();

        return response()->json($usuario);
    }
    //

    public function deletarUsuario($id){
        $usuario = Usuario::find($id);
        $usuario->delete();
        return response()->json('Deletado com sucesso', 200);
    }

    public function usuarioLogout(){
        Auth::logout();

        return response()->json('Usuario deslogou com sucesso.');
    }

}

