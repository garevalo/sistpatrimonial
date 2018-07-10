<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BienRequest;
use App\Http\Requests\BajaRequest;
use App\Bien;
use App\Color;
use App\Adquisicion;
use App\Modelo;
use App\Marca;
use App\Personal;
use App\CentroCosto;
use App\Movimiento;
use App\Catalogo;
use App\Proveedor;
use App\Local;
use App\Oficina;
use App\Transferencia;
use App\Baja;
use Carbon\Carbon;
use DB;
use Datatables;

use Illuminate\Support\Facades\Storage;

class BienController extends Controller
{   

    const REDIRECT = "bien.index";
    const MODULO   = "bien";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        return view('bien.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colores        =   Color::all();
        $adquisiciones  =   Adquisicion::all()->pluck('adquisicion','idadquisicion');
        $marcas         =   Marca::all();
        $modelos        =   Modelo::all();
        $personals      =   Personal::all();
        $centrocostos   =   CentroCosto::all();
        $estados        =   array(1=>'Activo',2=>'Inactivo');
        $proveedores    =   Proveedor::all()->pluck('razon_social','idproveedor');
        $locales        =   Local::all()->pluck('local','idlocal');
        $oficinas       =   Oficina::all()->pluck('oficina','idoficina');

        return view('bien.create',compact('colores','adquisiciones','marcas','modelos','personals','centrocostos','estados','proveedores','locales','oficinas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BienRequest $request)
    {

        $path = $request->file('imagen')->storeAs(
            'public/fotos', $request->codpatrimonial.'.'.$request->imagen->extension()
        );

       // DB::transaction(function () use ($request) {

            $bien = Bien::insertGetId([
                'codcatalogo'       => $request->codcatalogo,
                'codinventario'     => $request->codinventario,
                'codpatrimonial'    => $request->codpatrimonial,
                'ordencompra'       => $request->ordencompra,
                'idmarca'           => $request->idmarca,
                'idmodelo'          => $request->idmodelo,
                'idcolor'           => $request->idcolor,
                'imagen'            => asset(Storage::url($path)),
                'numserie'          => $request->numserie,
                'centrocosto'       => $request->centrocosto,
                'idpersonal'        => $request->idpersonal,
                'idestado'          => 1,
                'valor'             => $request->valor,
                'idadquisicion'     => $request->idadquisicion,
                'fecha_adquisicion' => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                'descripcion'       => $request->descripcion,
                'idproveedor'       => $request->idproveedor,
                'idlocal'           => $request->idlocal,
                'idoficina'         => $request->idoficina,
                'fecha_ordencompra' => Carbon::createFromFormat('d/m/Y', $request->fecha_ordencompra),
            ]);
            /*
            if($bien){
                Movimiento::create([
                    'idbien'            => $bien,
                    'codinventario'     => $request->codinventario,
                    'codpatrimonial'    => $request->codpatrimonial,
                    'centrocosto'       => $request->centrocosto,
                    'idpersonal'        => $request->idpersonal,
                    'idestado'          => $request->idestado,
                    'fecha_movimiento'  => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                    'idlocal'           => $request->idlocal,
                    'idoficina'         => $request->idoficina
                ]);
            }*/

        //});

        return redirect()->route(self::MODULO.'.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $estados        =   array(1=>'Activo',2=>'Inactivo');

        $bien    = Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','movimientos.personal','movimientos.centrocosto_destino','movimientos.personal_origen','movimientos.centrocosto_origen','local')->FindOrFail($id);

        $baja = Baja::with('bien.personal','bien.local','bien.centrocostos')->where('idbien',$id)->latest('idbaja')->first();

        //dd($baja);

        return view('bien.view',compact('estados','bien','baja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colores        =   Color::all()->pluck('color','idcolor');
        $adquisiciones  =   Adquisicion::all()->pluck('adquisicion','idadquisicion');
        $marcas         =   Marca::all()->pluck('marca','idmarca');
        $modelos        =   Modelo::all()->pluck('modelo','idmodelo');
        $personals      =   Personal::all()->pluck('FullName','idpersonal');
        $centrocostos   =   CentroCosto::all()->pluck('centrocosto','codcentrocosto');
        $estados        =   array(1=>'Activo',2=>'Inactivo');

        $proveedores    =   Proveedor::all()->pluck('razon_social','idproveedor');
        $locales        =   Local::all()->pluck('local','idlocal');
        $oficinas       =   Oficina::all()->pluck('oficina','idoficina');

        $bien    = Bien::with('catalogo')->FindOrFail($id);

        return view('bien.edit',compact('colores','adquisiciones','marcas','modelos','personals','centrocostos','estados','bien','proveedores','locales','oficinas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BienRequest $request, $id)
    {

        if($request->imagen){
             $path = $request->file('imagen')->storeAs(
                'public/fotos', $request->codpatrimonial.'.'.$request->imagen->extension()
            );

            $bien = Bien::FindOrFail($id)->update([
                'codcatalogo'       => $request->codcatalogo,
                'codinventario'     => $request->codinventario,
                'codpatrimonial'    => $request->codpatrimonial,
                'ordencompra'       => $request->ordencompra,
                'idmarca'           => $request->idmarca,
                'idmodelo'          => $request->idmodelo,
                'idcolor'           => $request->idcolor,
                'imagen'            => asset(Storage::url($path)),
                'numserie'          => $request->numserie,
                'centrocosto'       => $request->centrocosto,
                'idpersonal'        => $request->idpersonal,
                'idestado'          => $request->idestado,
                'valor'             => $request->valor,
                'idadquisicion'     => $request->idadquisicion,
                'fecha_adquisicion' => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                'descripcion'       => $request->descripcion,
                'idproveedor'       => $request->idproveedor,
                'idlocal'           => $request->idlocal,
                'idoficina'         => $request->idoficina,
                'fecha_ordencompra' => Carbon::createFromFormat('d/m/Y', $request->fecha_ordencompra),
            ]);
        } else{

            $bien = Bien::FindOrFail($id)->update([
                'codcatalogo'       => $request->codcatalogo,
                'codinventario'     => $request->codinventario,
                'codpatrimonial'    => $request->codpatrimonial,
                'ordencompra'       => $request->ordencompra,
                'idmarca'           => $request->idmarca,
                'idmodelo'          => $request->idmodelo,
                'idcolor'           => $request->idcolor,
                'numserie'          => $request->numserie,
                'centrocosto'       => $request->centrocosto,
                'idpersonal'        => $request->idpersonal,
                'idestado'          => $request->idestado,
                'valor'             => $request->valor,
                'idadquisicion'     => $request->idadquisicion,
                'fecha_adquisicion' => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                'descripcion'       => $request->descripcion,
                'idproveedor'       => $request->idproveedor,
                'idlocal'           => $request->idlocal,
                'idoficina'         => $request->idoficina,
                'fecha_ordencompra' => Carbon::createFromFormat('d/m/Y', $request->fecha_ordencompra),
            ]);
        }



        return redirect()->route(self::MODULO.'.index');
    }


    public function movimiento($id)
    {
        
        $personals      =   Personal::all();
        $centrocostos   =   CentroCosto::all();
        $catalogos       =   Catalogo::all();

        $estados        =   array(1=>'Activo',2=>'Inactivo');

        $bien    = Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','catalogo')->FindOrFail($id);

        return view('bien.movimiento',compact('personals','centrocostos','estados','catalogos','bien'));
    }

    public function movimientoStore(Request $request, $id)
    {

        DB::transaction(function () use ($request,$id) {
            Bien::FindOrFail($id)->update([
                'centrocosto'=> $request->centrocosto,
                'idpersonal' => $request->idpersonal
            ]);

            Movimiento::create([
                'idbien' => $id,
                'centrocosto' => $request->centrocosto,
                'idpersonal'  => $request->idpersonal,
                'fecha_movimiento'  => Carbon::now()
            ]);
        });

        

        return redirect()->route(self::REDIRECT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function dataTable(){
        //dd(Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','catalogo')->get());
        return Datatables::of(Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','catalogo')->get())
            ->addColumn('edit',function($bien){
                $btnbaja = '<p><a href="'.route('bien.baja',$bien->idbien).'" class="btn btn-danger btn-block btn-xs">Baja</a></p>';
                if($bien->idestado == 2){
                    $btnbaja = '<p><a href="'.route('bien.baja',$bien->idbien).'" class="btn btn-danger btn-block btn-xs disabled" disabled >Baja</a></p>';
                }
                //<p><a href="'.route('bien.movimiento',$bien->idbien).'" class="btn btn-success btn-block btn-xs">Transferir</a></p>
                return '<p><a href="'.route('bien.edit',$bien->idbien).'" class="btn btn-primary btn-block btn-xs">Editar</a></p>
                        <p><a href="'.route('bien.show',$bien->idbien).'" class="btn btn-info btn-block btn-xs">Ver</a></p>' . $btnbaja ;
            })
            ->addColumn('foto',function($bien){
                return '<img src="'.$bien->imagen.'" style="width: 120px;height: 100px;" >' ;
            })
            ->addColumn('marca',function($field){
                return $field->marca->marca;
            })
            ->addColumn('color',function($field){
                return $field->color->color;
            })
            ->addColumn('modelo',function($field){
                return $field->modelo->modelo;
            })
            ->addColumn('catalogo',function($field){
                return isset($field->catalogo->denom_catalogo)? $field->catalogo->denom_catalogo : '';
            })
            ->addColumn('estado',function($field){
                if($field->idestado==1){
                    return "<h4><label class='label label-info'>Activo</label></h4>";
                }else{
                    return "<h4><label class='label label-danger'>De Baja</label></h4>";
                }
            })
            ->addColumn('centrocosto',function($field){
                return isset($field->centrocostos->centrocosto) ? $field->centrocostos->centrocosto : '';
            })
            ->addColumn('responsable',function($field){
                return isset($field->personal->FullName) ? $field->personal->FullName : '';
            })
            ->rawColumns(['edit','foto','estado'])
            ->make(true);

    }
    
    public function items(Request $request,$id=null){

        $term       =   $request->term ? : ''; 

        $catalogo   =   Bien::whereHas('catalogo',function($query) use ($term){
            $query->where('denom_catalogo', 'like', $term.'%');
        })
        ->WhereHas('centrocostos',function($query){
            $query->where('centrocosto', 'like', 'ALMACEN%');
        })
        ->where('idestado',1)
        ->with('color','modelo','marca')->get();
        
        $result     =   array();

        foreach ($catalogo as $key => $value) {
            if( $id==$value->codcatalogo ){
                $result[]  = array(
                    'id'            => $value->idbien, 
                    'text'          => $value->catalogo->denom_catalogo.' | Marca: '. $value->marca->marca .' | Modelo: '. $value->modelo->modelo .' | Color: '. $value->color->color.'| CP: '.$value->codpatrimonial,
                    'term'          => $value->catalogo->denom_catalogo.'|'. $value->marca->marca , 
                    'codcatalogo'   => $value->codcatalogo,
                    "selected"      => true
                );  
            }else{
                $result[]  = array(
                    'id' => $value->idbien, 
                    'text'          => $value->catalogo->denom_catalogo.' | Marca: '. $value->marca->marca .' | Modelo: '. $value->modelo->modelo .' | Color: '. $value->color->color.'| CP: '.$value->codpatrimonial,
                    'term' => $value->catalogo->denom_catalogo.'|'. $value->marca->marca , 
                    'codcatalogo' => $value->codcatalogo
                );  
            }   
        }

        return response()->json(['results' => $result ]) ;
    }

    public function transferenciaIndex(){

        $bienes    = Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','movimientos','catalogo')->get();

        return view('bien.indextransferencia',compact('bienes')); 
    }

    public function transferenciaShow($idtransferencia){

        $transferencia    = Transferencia::with('CentrocostoOrigen','PersonalOrigen','CentrocostoDestino','PersonalDestino','movimiento.bien.catalogo')->where('idtransferencia',$idtransferencia)->first();
        
        return view('bien.showtransferencia',compact('transferencia'));

    }

    public function transferencia(){

        $personals      =   Personal::all();
        $centrocostos   =   CentroCosto::all();
        $catalogos       =   Catalogo::all();

        $estados        =   array(1=>'Activo',2=>'Inactivo');

        $bienes    = Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','movimientos','catalogo')->get();

        return view('bien.transferencia',compact('personals','centrocostos','estados','catalogos','bienes'));

    }


    public function transferenciaStore(Request $request){

        DB::transaction(function () use ($request) {
            
           $idtransferencia = Transferencia::insertGetId([
                'cc_origen'           => $request->centrocosto,
                'personal_origen'     => $request->idpersonal,
                'cc_destino'          => $request->centrocostodestino,
                'personal_destino'    => $request->idpersonaldestino
            ]);

            foreach ($request->bien as $key => $bien) {
                Bien::FindOrFail($key)->update([
                    'centrocosto'=> $request->centrocostodestino,
                    'idpersonal' => $request->idpersonaldestino
                ]); 

                Movimiento::create([
                    'idbien'            => $key,
                    'centrocosto'       => $request->centrocostodestino,
                    'idpersonal'        => $request->idpersonaldestino,
                    'desde_centrocosto' => $request->centrocosto,
                    'desde_personal'    => $request->idpersonal,
                    'fecha_movimiento'  => Carbon::now(),
                    'idtransferencia'   => $idtransferencia
                ]);
            }
            
        });

        return redirect()->route('indextransferencia');
    }

    
    public function getItemBy($model='Oficina',$by=null,$id=null){

        $model = app( str_replace(" ","","App\ ").$model);
         
        $result = $model::with('catalogo','color','marca')->where([$by=>$id,'idestado'=>1])->get();
               
        return response()->json($result);
    }

    public function getBienCod($codpatrimonial){
        $bien = Bien::select('codpatrimonial')->where("codcatalogo",$codpatrimonial)->latest('codpatrimonial')->first();
        return response()->json($bien);
    }

    public function dataTransferenciaTable(){
        //dd(Transferencia::with('CentrocostoOrigen','PersonalOrigen','CentrocostoDestino','PersonalDestino')->get());
        return Datatables::of(Transferencia::with('CentrocostoOrigen','PersonalOrigen','CentrocostoDestino','PersonalDestino')->get())
            ->addColumn('edit',function($field){
                return '<a href="'.route('showtransferencia',$field->idtransferencia).'" class="btn btn-info btn-xs">Ver</a>' ;
            })
            ->addColumn('ccorigen',function($field){
                return $field->CentrocostoOrigen->centrocosto;
            })
            ->addColumn('ccdestino',function($field){
                return $field->CentrocostoDestino->centrocosto;
            })
            ->addColumn('personaldestino',function($field){
                return $field->PersonalDestino->FullName;
            })
            ->addColumn('personalorigen',function($field){
                return $field->PersonalOrigen->FullName;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }

    public function baja($id){
        
        $personals      =   Personal::all()->pluck('FullName','idpersonal');
        $centrocostos   =   CentroCosto::all()->pluck('centrocosto','codcentrocosto');
        $locales        =   Local::all()->pluck('local','idlocal');
        $oficinas       =   Oficina::all()->pluck('oficina','idoficina');

        $bien    = Bien::with('catalogo')->FindOrFail($id);

        return view('bien.baja',compact('personals','centrocostos','bien','locales','oficinas','id'));
    }

    public function bajaStore(BajaRequest $request, $id){

        DB::transaction(function () use ($request,$id) {

            $path = $request->file('imagen')->storeAs(
                'public/fotos/baja/', $id.'.'.$request->imagen->extension()
            );

            Bien::FindOrFail($id)->update(['idestado'=>2]);

            Baja::create([
                'idlocal'       => $request->idlocal,
                'idoficina'     => $request->idoficina,
                'centrocosto'   => $request->centrocosto,
                'idpersonal'    => $request->idpersonal,
                'fechabaja'    => Carbon::createFromFormat('d/m/Y', $request->fechabaja),
                'descripcion'   => $request->descripcion,
                'imagen'        => asset(Storage::url($path)),
                'idbien'        => $id,
            ]);

        });

        return redirect()->route(self::MODULO.'.index');

    }
}
