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
    return view('index');
});

//redirects
Route::get('/registro', 'RegistroController@index')->name('registro');

Route::get('/login', 'Auth\LoginController@showLogin')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

//actions
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/login', 'Auth\LoginController@login');

//necesitas autentificación
Route::group(['middleware' => ['auth']], function () {
    //landing
    Route::get('/home', 'LandingController@index')->name('home');
    //Alta incidencias
    Route::get('/incidencias', 'IncidenciasController@index')->name('incidencias');
    //Recursos
    Route::get('/recursos', 'RecursosController@index')->name('recursos');
    //Alertantes
    //Route::get('/alertantes', 'AlertantesController@index')->name('alertantes');

});
