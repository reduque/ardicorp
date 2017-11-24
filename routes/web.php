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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('usuarios_estado/{id}/{estado}', 'UserController@usuarios_estado')->name('usuarios_estado');
    Route::get('edit_password/{id}', 'UserController@edit_password')->name('edit_password');
    Route::put('update_password/{id}', 'UserController@update_password')->name('update_password');
    Route::resource('usuarios', 'UserController');
    Route::get('edit_documentos/{id}', 'UserController@edit_documentos')->name('edit_documentos');
    Route::put('update_documentos/{id}', 'UserController@update_documentos')->name('update_documentos');


    Route::get('paises_eliminar/{id}', 'PaisController@destroy')->name('paises_eliminar');
    Route::resource('paises', 'PaisController');

    Route::get('clientes_estado/{id}/{estado}', 'ClienteController@clientes_estado')->name('clientes_estado');
    Route::resource('clientes', 'ClienteController');

    Route::get('documentotipos_estado/{id}/{estado}', 'DocumentoTipoController@documentotipos_estado')->name('documentotipos_estado');
    Route::resource('documentotipos', 'DocumentoTipoController');

    Route::resource('contenedores', 'ContenedorController');

    Route::get('documentos','DocumentosController@index')->name('documentos_index');
    Route::get('documentos_detalle/{id}','DocumentosController@detalle')->name('documentos_detalle');
    Route::get('cargar_documentos/{id}/{tipo}','DocumentosController@cargar_documentos')->name('cargar_documentos');
    Route::post('cargar_documentos2','DocumentosController@cargar')->name('cargar_documentos2');

    Route::get('navieras_estado/{id}/{estado}', 'NavieraController@navieras_estado')->name('navieras_estado');
    Route::resource('navieras', 'NavieraController');

    Route::get('productos_estado/{id}/{estado}', 'ProductoController@productos_estado')->name('productos_estado');
    Route::resource('productos', 'ProductoController');

    Route::get('destinos_estado/{id}/{estado}', 'DestinoController@destinos_estado')->name('destinos_estado');
    Route::resource('destinos', 'DestinoController');

    Route::get('plantas_estado/{id}/{estado}', 'PlantaProductoraController@plantas_estado')->name('plantas_estado');
    Route::resource('plantas', 'PlantaProductoraController');

    Route::get('empresas_estado/{id}/{estado}', 'EmpresaController@empresas_estado')->name('empresas_estado');
    Route::resource('empresas', 'EmpresaController');

    Route::get('agentes_estado/{id}/{estado}', 'AgenteController@agentes_estado')->name('agentes_estado');
    Route::resource('agentes', 'AgenteController');

    Route::resource('permisos', 'PermisoController');

    Route::get('origenes_estado/{id}/{estado}', 'OrigenController@origenes_estado')->name('origenes_estado');
    Route::resource('origenes', 'OrigenController');
});