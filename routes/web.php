<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/usuarios', 'UsuarioController@mostrarTodosUsuarios');

$router->group(['prefix' => 'usuario'], function () use($router){
    $router->post('/cadastrar', 'UsuarioController@cadastrarUsuario');

    $router->get('/{id}', 'UsuarioController@mostrarUsuario');

    $router->put('/{id}/atualizar', 'UsuarioController@atualizarUsuario');

    $router->delete('/{id}/deletar', 'UsuarioController@deletarUsuario');

    $router->post('/{id}/comentario', 'ComentarioController@cadastrarComentario');

    $router->put('/{id}/comentario', 'ComentarioController@atualizarComentario');

    $router->delete('/{id}/comentario', 'ComentarioController@deletarComentario');

    $router->get('/{id}/comentario/{id_comentario}', 'ComentarioController@showOne');

    $router->get('/{id}/comentario', 'ComentarioController@showAll');
});


$router->post('/login', 'UsuarioController@usuarioLogin');

$router->post('/info', 'UsuarioController@mostrarUsuarioAutenticado');

$router->post('/logout', 'UsuarioController@usuarioLogout');

$router->group(['prefix' => 'servico'], function () use($router){
    $router->post('/cadastrar', 'ServicoController@cadastrarServico');

    $router->get('/listar', 'ServicoController@mostrarServico');

    $router->put('/{id}/atualizar', 'ServicoController@atualizarServico');

    $router->delete('/{id}/deletar', 'ServicoController@deletarServico');
});
