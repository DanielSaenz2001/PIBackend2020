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
        Route::put('persona/{id}', 'PersonaController@update');
        Route::put('personaPersona/{id}', 'PersonaController@updatePersona');
        //---------------------/API-PERSONA----------------------\\

    


        Route::post('image', 'PersonaController2@upload');
        Route::get('users', 'PersonaController2@PersonasNull');
        Route::get('usuario', 'PersonaController2@me');
        Route::get('validar', 'PersonaController2@validacion');
        Route::get('personaUsuarios', 'PersonaController2@usuarios');
        Route::get('personaEgresado', 'PersonaController2@egresados');

        Route::get('egresadoPostgrado', 'PersonaController2@postgradosexperiencia');

        Route::put('personaUsuarios/{id}', 'PersonaController2@usuariosAC');
        Route::put('personaUsuariosRol/{id}', 'PersonaController2@usuariosROL');
        

        /***************************admin********************************/
        Route::get('adminpersona/{id}', 'AdminController@persona');
        Route::get('admindependiente/{id}', 'AdminController@dependiente');
        Route::get('adminegresado/{id}', 'AdminController@egresado');
        Route::get('adminegresadoescuela/{id}', 'AdminController@egresadoescuela');
        Route::get('adminformaciones/{id}', 'AdminController@formaciones');
        Route::get('admincapacitaciones/{id}', 'AdminController@capacitaciones');
        Route::get('adminempresas/{id}', 'AdminController@empresas');
        Route::get('adminexperiencia/{id}', 'AdminController@experiencia');
        /****************************admin****************************** */

        Route::put('userupdate/{id}', 'PersonaController2@updatepersonadi');
        Route::get('me2', 'AuthController@me');

        Route::get('DatosPersona', 'ValidadoresController@persona');
        Route::get('RolUsuario', 'ValidadoresController@Rol');
        Route::post('usuariosFiltro', 'UserController@filtro');
        Route::post('addEgresado', 'AuthController@addEgresado');
        Route::post('addEscuela', 'AuthController@addEscuela');
        


        Route::get('usuarios', 'UserController@index');
        Route::get('usuarios/{id}', 'UserController@show');
        Route::get('roles/{id}', 'UserController@rolesshow');
        Route::get('autorizadousuario/{id}', 'UserController@autorizadousuarioshow');
        Route::post('usuariosFiltro', 'UserController@filtro');
        Route::put('actualizarRolUsuario/{id}', 'UserController@actualizarRolUsuario');
        
        Route::put('actualizarAutorizacionUsuario/{id}', 'UserController@actualizarAutorizacionUsuario');
        // Social Authentication Routes 
        
});
$s = 'social.';
Route::get('/social/redirect/{provider}', [
	'as' => $s . 'redirect', 
	'uses' => 'SocialController@getSocialRedirect'
]);
Route::get('/social/handle/{provider}', [
	'as' => $s . 'handle', 
	'uses' => 'SocialController@getSocialHandle'
]);
