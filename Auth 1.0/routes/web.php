<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
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
Route::get('user-list-pdf/{id}', 'UserController@exportPdf') ->name('users.pdf');
Route::get('user-list-pdf2/{id}', 'UserController@exportPdf2') ->name('users.pdf');
Route::get('user-list-excel', 'UserController@exportExcel') ->name('users.excel');