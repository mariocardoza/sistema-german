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
    $users=\App\User::all()->count();
        if($users==0){
            return view('auth/register');

        }else{
            return view('auth/login');
        }
});



/*Route::get('/', function () {
    return view('auth.login');
});
*/
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('usuarios','UsuariosController@index')->middleware('Admin');
Route::get('usuarios/registrar','UsuariosController@registro')->middleware('Admin');
Route::get('usuarios/{id}', 'UsuariosController@buscar')->middleware('Admin');
Route::post('usuarios/save','UsuariosController@save')->middleware('Admin');
Route::put('usuarios/update','UsuariosController@update')->middleware('Admin');
Route::get('usuarios/borrar/{id}','UsuariosController@borrar')->middleware('Admin');
Route::put('usuarios/destoy','UsuariosController@destroy')->middleware('Admin');

route::get('home/perfil','UsuariosController@perfil');
route::get('perfil/{id}','UsuariosController@modificarperfil');
Route::put('updateperfil','UsuariosController@updateperfil');

//Route::Resource('bitacoras' , 'BitacoraController');
Route::get('bitacoras','BitacoraController@index');
Route::get('bitacoras/general','BitacoraController@general');
Route::get('bitacoras/usuario','BitacoraController@usuario');
Route::get('bitacoras/fecha','BitacoraController@fecha');

Route::post('proveedores/baja/{id}','ProveedorController@baja')->name('proveedores.baja');
Route::post('proveedores/alta/{id}','ProveedorController@alta')->name('proveedores.alta');
Route::Resource('proveedores','ProveedorController');

Route::post('contribuyentes/baja/{id}','ContribuyenteController@baja')->name('contribuyentes.baja');
Route::post('contribuyentes/alta/{id}','ContribuyenteController@alta')->name('contribuyentes.alta');
Route::get('contribuyentes/eliminados','ContribuyenteController@eliminados');
Route::Resource('contribuyentes','ContribuyenteController');

Route::delete('contratos/restore/{id}','ContratoController@restore')->name('contratos.restore');
Route::Resource('contratos','ContratoController');

Route::delete('proyectos/restore/{id}','ProyectoController@restore')->name('proyectos.restore');/
Route::get('proyectos/eliminados','ProyectosController@eliminados');
Route::get('proyectos','ProyectosController');