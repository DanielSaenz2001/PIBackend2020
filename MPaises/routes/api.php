<?php

use Illuminate\Http\Request;

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

header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 1000');
header('Access-Control-Allow-Headers: Authorization,Origin, Content-Type, X-Auth-Token, X-XSRF-TOKEN');

Route::group([
    
    'middleware' => 'api',

], function () {
//-----------------------API-PAISES------------------------\\
Route::get('paises', 'PaisController@paises');
Route::get('departamentos', 'PaisController@departamentos');
Route::get('provincias', 'PaisController@provincias');
Route::get('lugares', 'PaisController@lugares');
//-----------------------/API-PAISES------------------------\\
});