<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\BienRequest;
use App\Bien;
use App\Color;
use App\Adquisicion;
use App\Modelo;
use App\Marca;
use App\Personal;
use App\CentroCosto;
use App\Movimiento;
use App\Catalogo;
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
        $adquisiciones  =   Adquisicion::all();
        $marcas         =   Marca::all();
        $modelos        =   Modelo::all();
        $personals      =   Personal::all();
        $centrocostos   =   CentroCosto::all();
        $estados        =   array(1=>'Activo',2=>'Inactivo');

        return view('bien.create',compact('colores','adquisiciones','marcas','modelos','personals','centrocostos','estados'));
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
                'idestado'          => $request->idestado,
                'valor'             => $request->valor,
                'idadquisicion'     => $request->idadquisicion,
                'fecha_adquisicion' => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                'descripcion'       => $request->descripcion
            ]);

            if($bien){
                Movimiento::create([
                    'idbien'            => $bien,
                    'codinventario'     => $request->codinventario,
                    'codpatrimonial'    => $request->codpatrimonial,
                    'centrocosto'       => $request->centrocosto,
                    'idpersonal'        => $request->idpersonal,
                    'idestado'          => $request->idestado,
                    'fecha_movimiento'  => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion)
                ]);
            }

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
        $colores        =   Color::all();
        $adquisiciones  =   Adquisicion::all();
        $marcas         =   Marca::all();
        $modelos        =   Modelo::all();
        $personals      =   Personal::all();
        $centrocostos   =   CentroCosto::all();

        $estados        =   array(1=>'Activo',2=>'Inactivo');

        $bien    = Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','movimientos')->FindOrFail($id);

        return view('bien.view',compact('colores','adquisiciones','marcas','modelos','personals','centrocostos','estados','bien'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colores        =   Color::all();
        $adquisiciones  =   Adquisicion::all();
        $marcas         =   Marca::all();
        $modelos        =   Modelo::all();
        $personals      =   Personal::all();
        $centrocostos   =   CentroCosto::all();
        $estados        =   array(1=>'Activo',2=>'Inactivo');

        $bien    = Bien::FindOrFail($id);

        return view('bien.edit',compact('colores','adquisiciones','marcas','modelos','personals','centrocostos','estados','bien'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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



        return Datatables::of(Bien::with('marca','modelo','color','adquisicion','centrocostos','personal','catalogo')->get())
            ->addColumn('edit',function($bien){
                return '<a href="'.route('bien.edit',$bien->idbien).'" class="btn btn-primary btn-xs">Editar</a>
                        <a href="'.route('bien.movimiento',$bien->idbien).'" class="btn btn-success btn-xs">Transferir</a>
                        <a href="'.route('bien.show',$bien->idbien).'" class="btn btn-info btn-xs">Ver</a>' ;
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
                return $field->catalogo->denom_catalogo;
            })

            ->addColumn('estado',function($field){
                if($field->idestado==1){
                    return "Activo";
                }else{
                    return "Inactivo";
                }
            })
            ->addColumn('centrocosto',function($field){
                return isset($field->centrocostos->centrocosto) ? $field->centrocostos->centrocosto : '';
            })
            ->addColumn('responsable',function($field){
                return isset($field->personal->FullName) ? $field->personal->FullName : '';
            })
            ->rawColumns(['edit','foto'])
            ->make(true);

    }

    
    public function items(Request $request,$id=null){

        $term       =   $request->term ? : ''; 

        $catalogo   =   Bien::orWhereHas('catalogo',function($query) use ($term){
            $query->where('denom_catalogo', 'like', $term.'%');
        })->with('catalogo','color','modelo','marca')->get();
        
        $result     =   array();

        foreach ($catalogo as $key => $value) {
            if( $id==$value->codcatalogo ){
                $result[]  = array(
                    'id'            => $value->idbien, 
                    'text'          => $value->catalogo->denom_catalogo.' | Marca: '. $value->marca->marca .' | Modelo: '. $value->modelo->modelo .' | Color: '. $value->color->color,
                    'term'          => $value->catalogo->denom_catalogo.'|'. $value->marca->marca , 
                    'codcatalogo'   => $value->codcatalogo,
                    "selected"      => true
                );  
            }else{
                $result[]  = array(
                    'id' => $value->idbien, 
                    'text'          => $value->catalogo->denom_catalogo.' | Marca: '. $value->marca->marca .' | Modelo: '. $value->modelo->modelo .' | Color: '. $value->color->color,
                    'term' => $value->catalogo->denom_catalogo.'|'. $value->marca->marca , 
                    'codcatalogo' => $value->codcatalogo
                );  
            }   
        }

        return response()->json(['results' => $result ]) ;
    }
}
