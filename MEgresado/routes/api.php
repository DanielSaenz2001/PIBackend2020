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




Route::group([
    'middleware' => 'api',
], function () {
    Route::get('usuario2', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');
    Route::post('loginotro', 'AuthController@login');
    Route::post('google', 'AuthController@google');

    Route::get('egresado', 'EgresadosController@index');
    Route::get('egresado/{id}','EgresadosController@show');
    Route::post('egresadocodigo', 'BuscarEgresadosController@EgresadoCodigo');
    Route::post('egresadoFiltro', 'EgresadosController@filtrarEgresado');
    
    
    Route::post('egresado', 'EgresadosController@create');
    Route::get('egresadoProfesional', 'EgresadosController@profesional');
    Route::put('egresadoEgresado/{id}', 'EgresadosController@updateEgresado');
    Route::put('egresadoPersona/{id}', 'EgresadosController@PersonaEgresado');
    Route::put('egresadoestado/{id}', 'EgresadosController@updateestado');
    Route::get('administradoregresado/{id}','EgresadosController@administrador');

    Route::get('egresadoescuela/{id}','EgresadosEscuelasController@show');
    Route::post('egresadoescuela', 'EgresadosEscuelasController@create');

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
    Route::get('validarexp/{id}','ExperienciaLaboralesController@vervalidacion');
    Route::post('validarexp', 'ExperienciaLaboralesController@validar');
    
});
