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

DB::listen(function($sql) {
   // var_dump($sql);
});

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {


    Route::resource('sede','SedeController');

    //Bienes
    Route::get('bien/data/{model?}/{by?}/{id?}/{with?}','BienController@getItemBy')->name('getdatabien');

    Route::post('bien/baja/{id?}','BienController@bajaStore')->name('bajaStore');
    Route::get('bien/baja/{id?}','BienController@baja')->name('bien.baja');

    Route::get('transferencia/show/{idtransferencia?}','BienController@transferenciaShow')->name('showtransferencia');
    Route::get('transferencia','BienController@transferenciaIndex')->name('indextransferencia');
    Route::get('transferencia/alldata','BienController@dataTransferenciaTable')->name('gettransferencia');
    
    Route::post('bien/transferencia','BienController@transferenciaStore')->name('bien.transferenciastore');
    Route::get('bien/transferencia','BienController@transferencia')->name('bien.transferencia');
    
    Route::get('bien/getbiencod/{id?}','BienController@getBienCod')->name("getbiencod");
    Route::get('bien/items/{id?}','BienController@items')->name('bienitems');
    Route::get('bien/alldata','BienController@dataTable')->name('getbienes');
    Route::get('bien/movimiento/{id}','BienController@movimiento')->name('bien.movimiento');
    Route::post('bien/movimiento/{id}','BienController@movimientoStore')->name('bien.movimientostore');
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
    Route::get('clasegenerico/getclasesxgrupo/{id?}','ClaseGenericoController@getClasesByGrupo')->name('getclasesxgrupo');
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

    //Oficina
    Route::get('data/{model?}/{by?}/{id?}/{with?}','OficinaController@getItemBy')->name('getdata');
    Route::get('oficina/alldata','OficinaController@alldata')->name('getoficinas');
    Route::resource('oficina','OficinaController');

     //Centro Costo
    Route::get('centrocosto/alldata','CentroCostoController@alldata')->name('getcentrocostos');
    Route::resource('centrocosto','CentroCostoController');

    //Inventario
    Route::post('inventario/fisico/{id}','InventarioController@inventarioFisico')->name('inventario.fisico');
    Route::get('inventario/alldata','InventarioController@alldata')->name('getinventarios');
    Route::resource('inventario','InventarioController');

     //Pedido
    Route::post('pedido/atencion/{id}','PedidoController@atencionStore')->name('atencion.store');
    Route::get('pedido/atencion/{id?}','PedidoController@atencion')->name('atencion');
    Route::get('pedido/alldata','PedidoController@alldata')->name('getpedidos');
    Route::resource('pedido','PedidoController');
    
    //Personal
    Route::resource('personal','PersonalController');
    
    //Roles
    Route::get('rol/alldata','RolController@alldata')->name('getroles');
    Route::resource('rol','RolController');

    //Usuarios
    Route::get('usuario/alldata','UsuarioController@getalldata')->name('getalldatausuario');
    Route::resource('usuario','UsuarioController');

    //Reportes
    Route::post('reporte/inventario','ReporteController@inventarioPdf')->name('reporteInventario');
    Route::get('reporte/inventario','ReporteController@inventario');

    Route::post('reporte/nivelexactitud','ReporteController@nivelExactitudPdf');
    Route::get('reporte/nivelexactitud','ReporteController@nivelexactitud');

    Route::post('reporte/nivelcumplimiento','ReporteController@nivelCumplimientoPdf');
    Route::get('reporte/nivelcumplimiento','ReporteController@nivelcumplimiento');
    Route::resource('reporte','ReporteController');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'role'], function() {

    });

    
});


