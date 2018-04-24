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
use Carbon\Carbon;
use DB;
use Datatables;

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
        $estados = array(1=>'Activo',2=>'Inactivo');
        echo "<img src='".asset('storage/fotos/123.png')."'>";
        //return view('bien.create',compact('colores','adquisiciones','marcas','modelos','personals','centrocostos','estados'));
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
            'fotos', $request->codpatrimonial.'.'.$request->imagen->extension()
        );

        Bien::create([
            'codcatalogo'       => $request->codcatalogo,
            'codinventario'     => $request->codinventario,
            'codpatrimonial'    => $request->codpatrimonial,
            'ordencompra'       => $request->ordencompra,
            'idmarca'           => $request->idmarca,
            'idmodelo'          => $request->idmodelo,
            'idcolor'           => $request->idcolor,
            'imagen'            => asset('storage/'.$path),
            'numserie'          => $request->numserie,
            'centrocosto'       => $request->centrocosto,
            'idpersonal'        => $request->idpersonal,
            'idestado'          => $request->idestado,
            'valor'             => $request->valor,
            'idadquisicion'     => $request->idadquisicion,
            'fecha_adquisicion' => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
            'descripcion'       => $request->descripcion
        ]);

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

        return Datatables::of(Bien::all())
            ->addColumn('edit',function($bien){
                return '<a href="'.route('bien.edit',$bien->idbien).'" class="btn btn-primary btn-sm">Movimientos</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
