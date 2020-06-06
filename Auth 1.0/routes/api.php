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
    
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendEmail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    //-----------------------/API-JWT------------------------\\

    //---------------------API-PERSONA----------------------\\
    Route::get('users', 'PersonaController@PersonasNull');
    Route::get('usuario', 'PersonaController@me');
    Route::get('persona', 'PersonaController@index');
    Route::get('persona/{id}','PersonaController@show');
    
    Route::post('persona', 'PersonaController@create');
    Route::put('persona/{id}', 'PersonaController@update');
    Route::delete('persona/{id}', 'PersonaController@destroy');
    //---------------------/API-PERSONA----------------------\\

    


    Route::post('image', 'PersonaController@upload');


        Route::get('personaUsuarios', 'PersonaController@usuarios');
        Route::put('personaUsuarios/{id}', 'PersonaController@usuariosAC');
        Route::put('personaUsuarioss/{id}', 'PersonaController@usuariosROL');

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


});

