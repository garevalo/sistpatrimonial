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
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {

    Route::resource('subgerencia','SubgerenciaController');
    Route::resource('gerencia','GerenciaController');
    Route::resource('sede','SedeController');
    Route::resource('cargo','CargoController');
    Route::resource('personal','PersonalController');
    Route::get('rol/alldata','RolController@alldata')->name('getroles');
    Route::resource('rol','RolController');

    Route::get('usuario/alldata','UsuarioController@getalldata')->name('getalldatausuario');
    Route::resource('usuario','UsuarioController');

    Route::resource('activo','ActivoController');
    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'role'], function() {



    });

    
});


