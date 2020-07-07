<?php

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Authorization,Origin, Content-Type, X-Auth-Token, X-XSRF-TOKEN');

Route::group([
    
    'middleware' => 'api',

], function () {
       

        Route::put('userupdate/{id}', 'PersonaController2@updatepersonadi');

        Route::get('usuarios', 'UserController@index');
        Route::get('usuarios/{id}', 'UserController@show');
        Route::get('roles/{id}', 'UserController@rolesshow');
        Route::get('autorizadousuario/{id}', 'UserController@autorizadousuarioshow');
        Route::post('usuariosFiltro', 'UserController@filtro');
        Route::put('actualizarRolUsuario/{id}', 'UserController@actualizarRolUsuario');
        
        Route::put('actualizarAutorizacionUsuario/{id}', 'UserController@actualizarAutorizacionUsuario');
        // actualizarRolUsuario actualizarAutorizacionUsuario
        
});

