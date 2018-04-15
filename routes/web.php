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

    //Bienes
    Route::get('bien/alldata','BienController@alldata')->name('getbienes');
    Route::resource('bien','BienController');

    //Marcas
    Route::get('marca/alldata','MarcaController@alldata')->name('getmarcas');
    Route::resource('marca','MarcaController');

    //Modelos
    Route::get('modelo/alldata','ModeloController@alldata')->name('getmodelos');
    Route::resource('modelo','ModeloController');

    //Colores
    Route::get('color/alldata','ColorController@alldata')->name('getcolores');
    Route::resource('color','ColorController');

    //Adquisiones
    Route::get('adquisicion/alldata','AdquisicionController@alldata')->name('getadquisiciones');
    Route::resource('adquisicion','AdquisicionController');

    //Catalogo
    Route::get('catalogo/alldata','CatalogoController@alldata')->name('getcatalogos');
    Route::resource('catalogo','CatalogoController');

     //Catalogo
    Route::get('cargo/alldata','CargoController@alldata')->name('getcargos');
    Route::resource('cargo','CargoController');
    
    //Personal
    Route::resource('personal','PersonalController');
    
    //Roles
    Route::get('rol/alldata','RolController@alldata')->name('getroles');
    Route::resource('rol','RolController');

    //Usuarios
    Route::get('usuario/alldata','UsuarioController@getalldata')->name('getalldatausuario');
    Route::resource('usuario','UsuarioController');


    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'role'], function() {

    });

    
});


