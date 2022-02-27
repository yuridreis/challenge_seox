<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->group(['prefix' => 'clientes'], function () use ($router) {
    $router->get('/', 'ClientesController@index');
    $router->get('/{cliente}', 'ClientesController@show');
    $router->post('/', 'ClientesController@store');
    $router->put('/{cliente}', 'ClientesController@update');
    $router->delete('/{cliente}', 'ClientesController@destroy');
});

$router->group(['prefix' => 'imoveis'], function () use ($router) {
    $router->get('/', 'ImoveisController@index');
    $router->get('/{imovel}', 'ImoveisController@show');
    $router->post('/', 'ImoveisController@store');
    $router->put('/{imovel}', 'ImoveisController@update');
    $router->delete('/{imovel}', 'ImoveisController@destroy');
});

$router->group(['prefix' => 'oportunidades'], function () use ($router) {
    $router->get('/', 'OportunidadesController@index');
    $router->get('/{oportunidade}', 'OportunidadesController@show');
    $router->post('/', 'OportunidadesController@store');
    $router->put('/{oportunidade}', 'OportunidadesController@update');
    $router->delete('/{oportunidade}', 'OportunidadesController@destroy');
});