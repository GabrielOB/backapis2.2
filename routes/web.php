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

    $router->put('/{id}', 'UsuarioController@atualizarUsuario');

    $router->delete('/{id}', 'UsuarioController@deletarUsuario');

    $router->get('/prestadores', 'UsuarioController@listarPrestadores');

    $router->get('/clientes', 'UsuarioController@listarClientes');

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

    $router->post('/{id}/avaliacao', 'AvaliacaoController@cadastrarAvaliacao');

    $router->get('/{id}/showAll', 'AvaliacaoController@mostrarAvaliacao');

    $router->delete('/{id_avaliacao}/deleteAvaliacao', 'AvaliacaoController@deletarAvaliacao');
});


$router->post('/login', 'UsuarioController@usuarioLogin');

$router->post('/info', 'UsuarioController@mostrarUsuarioAutenticado');

$router->post('/logout', 'UsuarioController@usuarioLogout');

$router->group(['prefix' => 'servico'], function () use($router){
    $router->post('/cadastrar', 'ServicoController@cadastrarServico');

    $router->get('/listar', 'ServicoController@mostrarServico');

    $router->put('/{id}', 'ServicoController@atualizarServico');

    $router->delete('/{id}', 'ServicoController@deletarServico');
});

$router->get('/servicos', 'ServicoController@mostrarTodosServicos');
