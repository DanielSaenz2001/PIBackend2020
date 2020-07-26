<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Authorization,Origin, Content-Type, X-Auth-Token, X-XSRF-TOKEN,id');

Route::group([
    
    'middleware' => 'api',

], function () {
   
Route::get('usuario2', 'AuthController@me');
Route::post('logout', 'AuthController@logout');
Route::post('loginotro', 'AuthController@login');
Route::post('google', 'AuthController@google');

Route::get('eventos', 'EventosController@index');
Route::post('eventos', 'EventosController@create');
Route::get('eventos/{id}', 'EventosController@show');
Route::put('eventos/{id}', 'EventosController@update');
Route::delete('eventos/{id}', 'EventosController@destroy');
Route::get('eventosDispo', 'EventosController@visibles');
//-----------------------/API-Eventos------------------------\\indexNorespuesta
Route::get('Comentarios', 'ComentariosController@index');
Route::get('ComentariosNoRespuesta', 'ComentariosController@indexNorespuesta');
Route::post('Comentarios', 'ComentariosController@create');
Route::get('Comentarios/{id}', 'ComentariosController@show');
Route::get('ComentariosRespuesta/{id}', 'ComentariosController@showRespuesta');
Route::put('Comentarios/{id}', 'ComentariosController@update');
Route::put('ComentariosUpdateRespuesta/{id}', 'ComentariosController@Respuesta');
Route::delete('Comentarios/{id}', 'ComentariosController@destroy');
Route::get('ComentariosDispo', 'ComentariosController@norespuesta');
//-----------------------/API-Comentario------------------------\\

Route::get('paises', 'PaisController@paises');
Route::get('departamentos', 'PaisController@departamentos');
Route::get('provincias', 'PaisController@provincias');
Route::get('lugares', 'PaisController@lugares');
Route::get('distritos', 'PaisController@distritos');

Route::get('facultades', 'UPEUContoller@facultades');
Route::get('escuelas', 'UPEUContoller@escuelas');
Route::post('egresaoescuela', 'UPEUContoller@egresadoescuela');
});