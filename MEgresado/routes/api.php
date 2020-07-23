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
Route::get('egresadoescuela/{id}','EgresadosEscuelasController@show');
Route::post('egresado', 'EgresadosController@create');
Route::post('egresadoescuela', 'EgresadosEscuelasController@create');
Route::put('egresado/{id}', 'EgresadosController@update');
Route::put('egresadoEgresado/{id}', 'EgresadosController@updateEgresado');
Route::put('egresadoPersona/{id}', 'EgresadosController@PersonaEgresado');
Route::post('egresadoFiltro', 'EgresadosController@filtrarEgresado');

Route::get('postgrado', 'PostgradosController@index');
Route::get('postgrado/{id}','PostgradosController@show');
Route::post('postgrado', 'PostgradosController@create');
Route::put('postgrado/{id}', 'PostgradosController@update');
Route::delete('postgrado/{id}', 'PostgradosController@destroy');

Route::get('experiencia', 'ExperienciaLaboralesController@index');
Route::get('experiencia/{id}','ExperienciaLaboralesController@show');
Route::post('experiencia', 'ExperienciaLaboralesController@create');
Route::put('experiencia/{id}', 'ExperienciaLaboralesController@update');
Route::delete('experiencia/{id}', 'ExperienciaLaboralesController@destroy');

Route::post('egresadocodigo', 'EgresadosController@EgresadoCodigo');
Route::get('egresadome', 'PruebaController@me');
Route::put('egresadoestado/{id}', 'EgresadosController@updateestado');


Route::put('administradoregresado/{id}','EgresadosController@administrador');
Route::get('validarexp/{id}','ExperienciaLaboralesController@vervalidacion');
Route::post('validarexp', 'ExperienciaLaboralesController@validar');
