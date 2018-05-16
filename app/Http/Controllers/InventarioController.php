<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Personal;
use App\CentroCosto;
use Carbon\Carbon;
use Datatables;


class InventarioController extends Controller
{

    const REDIRECT = "inventario.index";
    const MODULO   = "inventario";
    const TITLEMOD = 'Inventario';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulo      =  self::MODULO;
        $titulomod   =  self::TITLEMOD;
        return view(self::MODULO.'.index',compact('modulo','titulomod'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;
        $table = new Inventario;

        $personals = Personal::all()->pluck('FullName','idpersonal'); 
        $centrocostos = CentroCosto::all()->pluck('centrocosto','codcentrocosto');

        return view(self::MODULO.'.create',compact('modulo','table','titulomod','personals','centrocostos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Inventario::create(
            $request->all()
        );
        return redirect()->route(self::REDIRECT);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table      = Inventario::FindOrFail($id);
        $modulo     = self::MODULO;
        $titulomod  = self::TITLEMOD;

        return view(self::MODULO.".edit",compact('table','modulo','titulomod'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Inventario::FindOrFail($id);
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;

        return view(self::MODULO.".edit",compact('table','modulo','titulomod'));
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
        Inventario::FindOrFail($id)->update($request->all());
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

    public function alldata(){

        return Datatables::of(Inventario::with('CentroCosto','Personal')->get())
            ->addColumn('edit',function($table){
                return '<a href="'.route('inventario.edit',$table->idinventario).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->addColumn('centro_costo',function($table){
                return $table->CentroCosto->centrocosto;
            })
            ->addColumn('personal',function($table){
                return $table->Personal->FullName;
            })
            ->addColumn('fechahasta',function($table){
                return $table->fecha_hasta->format('d/m/Y');
            })
            ->addColumn('fechadesde',function($table){
                return $table->fecha_desde->format('d/m/Y');
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
