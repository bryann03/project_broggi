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

Route::get('/incidencias', 'Incidencias@index');


Route::get('/registro', 'RegistroController@index');
Route::get('/registroIncidencias', 'RegistroIncidencias@index');
