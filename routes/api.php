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

// Contribuyentes
Route::resource('contribuyentes', 'ContribuyenteApiController');
Route::post('contribuyentes/updateLatLng', 'ContribuyenteApiController@onUpdateContribuyenteInmueble');
Route::post('contribuyentes/darBajaContribuyente', 'ContribuyenteApiController@darBajaContribuyente');
Route::post('contribuyentes/update', 'ContribuyenteApiController@onUpdateContribuyente');

// Inmuebles
Route::resource('inmuebles', 'InmuebleController');
Route::post('inmuebles/addTipoServicio', 'InmuebleController@addTipoServicioInmueble');
Route::post('inmuebles/removeTipoServicio', 'InmuebleController@removeTipoServicioInmueble');

// Tipo Servicio
Route::resource('tipo_servicios', 'TipoServicioController');