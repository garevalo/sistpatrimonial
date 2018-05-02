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
    Route::get('bien/alldata','BienController@dataTable')->name('getbienes');
    Route::get('bien/movimiento/{id}','BienController@movimiento')->name('bien.movimiento');
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

    //Grupo Generico
    Route::get('grupogenerico/alldata','GrupoGenericoController@alldata')->name('getgruposgenericos');
    Route::resource('grupogenerico','GrupoGenericoController');

    //clase Generico
    Route::get('clasegenerico/getclasesxgrupo/{id}','ClaseGenericoController@getClasesByGrupo')->name('getclasesxgrupo');
    Route::get('clasegenerico/alldata','ClaseGenericoController@alldata')->name('getclasesgenericos');
    Route::resource('clasegenerico','ClaseGenericoController');

    //Catalogo
    Route::get('catalogo/items/{id?}','CatalogoController@items')->name('catalogoitems');
    Route::get('catalogo/alldata','CatalogoController@alldata')->name('getcatalogos');
    Route::resource('catalogo','CatalogoController');

     //Cargo
    Route::get('cargo/alldata','CargoController@alldata')->name('getcargos');
    Route::resource('cargo','CargoController');

    //Proveedor
    Route::get('proveedor/alldata','ProveedorController@alldata')->name('getproveedores');
    Route::resource('proveedor','ProveedorController');

     //Local
    Route::get('local/alldata','LocalController@alldata')->name('getlocales');
    Route::resource('local','LocalController');
    
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


