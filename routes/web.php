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


Route::get('/registro', 'RegistroController@index')->name('registro');

Route::get('/login', 'Auth\LoginController@showLogin')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/login', 'Auth\LoginController@login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'LandingController@index')->name('home');
});

//Route::get('/principal', ['middleware' => 'auth', 'uses' => 'LandingController@index']);
