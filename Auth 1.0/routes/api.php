<?php
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Authorization,Origin, Content-Type, X-Auth-Token, X-XSRF-TOKEN');

//-----------------------Auth------------------------\\
Route::group([
    
    'middleware' => 'api',

], function () {
        //-----------------------API-JWT------------------------\\
        Route::post('login', 'AuthController@login');
        Route::post('signup', 'AuthController@signup');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        
        Route::post('signupadministrador', 'AuthController@signupadministrador');
        Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
        Route::post('resetPassword', 'ChangePasswordController@process');
        //-----------------------/API-JWT------------------------\\

        //---------------------API-PERSONA----------------------\\


        Route::get('persona', 'PersonaController@index');
        Route::get('persona/{id}','PersonaController@show');
        Route::post('persona', 'PersonaController@create');
        Route::post('personaadministrador', 'PersonaController@createAdministrador');
        Route::put('personaPersona/{id}', 'PersonaController@updatePersona');
        //---------------------/API-PERSONA----------------------\\

    
        //---------------------API-PERSONA2----------------------\\
        Route::get('personaEgresado', 'PersonaController2@egresados');
        Route::get('egresadoPostgrado', 'PersonaController2@postgradosexperiencia');
        
        
        //---------------------/API-PERSONA2----------------------\\


        Route::get('me2', 'AuthController@me');
        
        Route::get('DatosPersona', 'ValidadoresController@persona');
        Route::get('RolUsuario', 'ValidadoresController@Rol');
        Route::post('addEgresado', 'ValidadoresController@addEgresado');
        Route::post('addEscuela', 'ValidadoresController@addEscuela');
        

        //---------------------API-UserController----------------------\\
        Route::get('usuarios', 'UserController@index');
        Route::post('usuariosFiltro', 'UserController@filtro');
        Route::get('usuarios/{id}', 'UserController@show');
        Route::get('roles/{id}', 'UserController@rolesshow');
        Route::get('autorizadousuario/{id}', 'UserController@autorizadousuarioshow');

        Route::put('actualizarRolUsuario/{id}', 'UserController@actualizarRolUsuario');
        Route::put('actualizarAutorizacionUsuario/{id}', 'UserController@actualizarAutorizacionUsuario');
        //---------------------/API-UserController----------------------\\
        
});
// Social Authentication Routes 
$s = 'social.';
Route::get('/social/redirect/{provider}', [
	'as' => $s . 'redirect', 
	'uses' => 'SocialController@getSocialRedirect'
]);
Route::get('/social/handle/{provider}', [
	'as' => $s . 'handle', 
	'uses' => 'SocialController@getSocialHandle'
]);
