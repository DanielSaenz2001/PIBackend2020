<?php

use Illuminate\Http\Request;
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Authorization,Origin, Content-Type, X-Auth-Token, X-XSRF-TOKEN');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('egresado', 'EgresadosController@index');
Route::get('egresado/{id}','EgresadosController@show');
Route::post('egresado', 'EgresadosController@create');
Route::post('egresadoescuela', 'EgresadosEscuelasController@create');
Route::put('egresado/{id}', 'EgresadosController@update');
Route::put('egresadoPersona/{id}', 'EgresadosController@PersonaEgresado');
Route::post('egresadoFiltro', 'EgresadosController@filtrarEgresado');