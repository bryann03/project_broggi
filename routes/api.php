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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('usuaris', 'Api\UsuarisController');
Route::apiResource('rols', 'Api\RolsController');
Route::apiResource('municipis', 'Api\MunicipisController');
Route::apiResource('alertants', 'Api\AlertantsController');
Route::apiResource('tipus_alertant', 'Api\TipusAlertantController');
Route::apiResource('tipus_incident', 'Api\TipusIncidentController');
Route::apiResource('tipus_recurs', 'Api\TipusRecursController');
Route::apiResource('recursos', 'Api\RecursosController');
Route::apiResource('incidencies', 'Api\IncidenciesController');
Route::apiResource('estats_incidencia', 'Api\EstatsIncidenciaController');
