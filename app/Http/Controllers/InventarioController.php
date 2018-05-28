<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventario;
use App\Personal;
use App\CentroCosto;
use App\biens;
use App\ConteoInventario;
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
        $table  = Inventario::FindOrFail($id);
        $situacion = [1=>'Conciliado',2 => 'Faltante'];
        
        $bienes = ConteoInventario::with('bien','catalogo')->where('idinventario',$id)->get();        
        $centrocosto = CentroCosto::with('bien.catalogo')->where('codcentrocosto', $table->centrocosto)->first();
        
        //dump($bienes);
        //dd($centrocosto);

        $modulo     = self::MODULO;
        $titulomod  = self::TITLEMOD;

        return view(self::MODULO.".show",compact('table','modulo','titulomod','centrocosto','situacion','bienes'));
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

    public function inventarioFisico(Request $request, $id){

        //dd($request->all());
        foreach ($request->idbien as $key => $value) {


            $ConteoInventario = ConteoInventario::updateOrCreate(
                [
                    'idinventario'  => $request->idinventario, 
                    'codcatalogo'   => $request->codcatalogo[$key],
                    'codinventario' => $request->codinventario[$key],
                    'idbien'        => $value 
                ],
                [
                    'idinventario'  => $request->idinventario, 
                    'codcatalogo'   => $request->codcatalogo[$key],
                    'codinventario' => $request->codinventario[$key],
                    'codpatrimonial'=> $request->codpatrimonial[$key],
                    'idbien'        => $value,
                    'situacion'     => $request->situacion[$key],
                    'fecha_conteo'  => Carbon::now()
                ]
            );
            
        }
        return redirect()->route(self::REDIRECT);
    }

    public function alldata(){

        return Datatables::of(Inventario::with('CentroCosto','Personal')->get())
            ->addColumn('edit',function($table){
                return '<a href="'.route('inventario.show',$table->idinventario).'" class="btn btn-primary btn-sm">Inventario Físico</a>' ;
            })
            ->addColumn('centro_costo',function($table){
                return $table->CentroCosto->centrocosto;
            })
            ->addColumn('personal',function($table){
                return $table->Personal->FullName;
            })
            ->addColumn('fechadesde',function($table){
                return $table->fecha_desde->format('d/m/Y');
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
