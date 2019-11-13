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

    $router->get('/prestadores', 'UsuarioController@listarPrestadores');

    $router->get('/clientes', 'UsuarioController@listarClientes');

$router->group(['prefix' => 'usuario'], function () use($router){
    $router->post('/cadastrar', 'UsuarioController@cadastrarUsuario');

    $router->get('/{id}', 'UsuarioController@mostrarUsuario');

    $router->put('/{id}', 'UsuarioController@atualizarUsuario');

    $router->delete('/{id}', 'UsuarioController@deletarUsuario');

    $router->group(['prefix' => '{id}/comentario'], function() use($router){
        $router->post('/', 'ComentarioController@cadastrarComentario');

        $router->put('/', 'ComentarioController@atualizarComentario');

        $router->delete('/', 'ComentarioController@deletarComentario');

        $router->get('/{id_comentario}', 'ComentarioController@showOne');

        $router->get('/', 'ComentarioController@showAll');
    });

    $router->group(['prefix' => '{id}/contrato'], function() use($router){
        $router->get('/', 'ContratoController@index');

        $router->get('/{id_contrato}', 'ContratoController@show');

        $router->post('/', 'ContratoController@store');

        $router->put('/{id_contrato}', 'ContratoController@update');

        $router->delete('/{id_contrato}', 'ContratoController@delete');
    });

    $router->group(['prefix' => '{id}/prestador'], function() use($router){
        $router->post('/', 'PrestadorController@store');

        $router->get('/', 'PrestadorController@show');

        $router->delete('/', 'PrestadorController@delete');

        $router->put('/', 'PrestadorController@update');
    });

});

$router->group(['prefix' => 'avaliacoes'], function () use ($router){

    $router->post('/', 'AvaliacaoController@store');

    $router->get('/', 'AvaliacaoController@index');

    $router->get('/{id_prestador}', 'AvaliacaoController@show');

    $router->delete('/delete/{id_avaliacao}', 'AvaliacaoController@delete');

});

$router->group(['prefix' => 'chat'], function () use ($router){

    $router->get('/dev', 'ChatController@index');
    $router->get('/dev/{id_chat}', 'ChatController@show');

    $router->post('/', 'ChatController@store');
    $router->get('/', 'ChatUserController@index');

    $router->get('/{id_chat}', 'ChatMessageController@index');
    $router->post('/{id_chat}', 'ChatMessageController@store');



});



$router->post('/login', 'UsuarioController@usuarioLogin');

$router->get('/info', 'UsuarioController@mostrarUsuarioAutenticado');

$router->post('/logout', 'UsuarioController@usuarioLogout');

$router->group(['prefix' => 'servico'], function () use($router){
    $router->post('/cadastrar', 'ServicoController@cadastrarServico');

    $router->get('/{id}/listar', 'ServicoController@mostrarServico');

    $router->put('/{id}', 'ServicoController@atualizarServico');

    $router->delete('/{id}', 'ServicoController@deletarServico');
});

$router->get('/servicos', 'ServicoController@mostrarTodosServicos');
