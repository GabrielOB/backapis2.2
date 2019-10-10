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
        $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        if(! $token = $this->jwt->claims(['email' => $request->email])->attempt($request->only('email', 'password'))){
            return response()->json(['Usuario não encontrado'], 404);
        }

        // $usuario = Usuario::where([['email', '=', $request->email], ['password', '=', Hash::make($request->password)]])->get();

        return response()->json(['token' => $token, 'usuario' => Auth::user()]);
        // return response()->json(compact('token'));
    }

    public function mostrarUsuarioAutenticado(){
        return response()->json(Auth::user());
    }

    //dev
    public function mostrarTodosUsuarios(){
        return response()->json(Usuario::all());
    }

    public function cadastrarUsuario(Request $request){
        //Validação
        $this->validate($request, [
            'usuario' => 'required|min:5|max:40',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required',
            'cpf' => 'required',
            'endereco' => 'required',
            'telefone' => 'required',
            'prestador' => 'nullable'
        ]);


        //Inserindo usuário
        $usuario = new Usuario;
        $usuario->email = $request->email;
        $usuario->usuario = $request->usuario;
        $usuario->password = Hash::make($request->password);
        $usuario->cpf = $request->cpf;
        $usuario->telefone = $request->telefone;
        $usuario->endereco = $request->endereco;
        $usuario->prestador = isset($request->prestador) ? $request->prestador : false;

        //Salvar registro no banco
        $usuario->save();

        $token = $this->jwt->claims(['email' => $request->email])->attempt($request->only('email', 'password'));
        return response()->json(["usuario" => $usuario, "token" => $token]);
    }

    //dev
    public function mostrarUsuario($id){
        return response()->json(Usuario::find($id));
    }

    public function atualizarUsuario($id, Request $request){
        $usuario = Usuario::find($id)->update([
            'email' => $request->email,
            'usuario' => $request->usuario,
            'password' => $request->password
        ]);

        return response()->json($usuario);
    }
    //

    public function deletarUsuario($id){
        $usuario = Usuario::find($id)->delete();
        return response()->json(['msg' => 'Deletado com sucesso'], 200);
    }

    public function usuarioLogout(){
        Auth::logout();

        return response()->json('Usuario deslogou com sucesso.');
    }

    //Acho que esse método pertence ao controller de serviços
    public function removerServico(Usuario $usuario, $id)
    {
        $servico = Servico::find($id);
        $usuario->servicos()->detach($servico);
        return response()->json('Categoria deletada com sucesso.');
    }

    public function listarPrestadores(Request $request){
        // $prestadores = Usuario::where('prestador', true)->join('prestadors', 'prestadors.id_usuario', '=', 'usuarios.id')->get();
        $prestadores = Usuario::where('prestador', true)->get();
        return response()->json($prestadores);
    }

    //dev
    public function listarClientes(Request $request){
        $clientes = Usuario::where('prestador', false)->get();
        return response()->json($clientes);
    }

}

