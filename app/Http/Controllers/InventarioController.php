<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Inventario;
use App\Personal;
use App\CentroCosto;
use App\biens;
use App\ConteoInventario;
use App\User;
use DB;
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
        $estados = array(1=>'En Curso',2=>'Cerrado');
        $table = new Inventario;

        $personals = User::all()
                        ->where('estado',1)
                        ->where('idrol',2)
                        ->pluck('FullUser','id');

        $centrocostos = CentroCosto::all()->pluck('centrocosto','codcentrocosto');

        return view(self::MODULO.'.create',compact('modulo','table','titulomod','personals','centrocostos','estados'));
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
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;
        $estados = array(1=>'En Curso',2=>'Cerrado');
        $table = Inventario::FindOrFail($id);

        $personals = User::all()->where('estado',1)->where('idrol',2)->pluck('FullUser','id');

        $centrocostos = CentroCosto::all()->pluck('centrocosto','codcentrocosto');

        return view(self::MODULO.'.edit',compact('modulo','table','titulomod','personals','centrocostos','estados'));
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
        Inventario::destroy($id);
        return redirect()->route(self::REDIRECT);
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

        if(Auth::user()->idrol==2)
            $query = Inventario::with('CentroCosto','User')->where('idpersonal',Auth::user()->id)->get();
        else
            $query = Inventario::with('CentroCosto','User')->get();

        return Datatables::of($query)
            ->addColumn('edit',function($table){
                $invfisico = '<a href="'.route('inventario.show',$table->idinventario).'" class="btn btn-primary btn-xs">Inventario Físico</a>';
                $edit   = '<a href="'.route('inventario.edit',$table->idinventario).'" class="btn btn-info btn-xs">Editar</a>';
                $delete = '<a href="'.route('inventario.destroy',$table->idinventario).'" class="btn btn-danger btn-xs" onclick="borrar()">Eliminar</a>';
                return  $invfisico.' '.$edit.' '.$delete;

            })
            ->addColumn('centro_costo',function($table){
                return $table->CentroCosto->centrocosto;
            })
            ->addColumn('user',function($table){
               return ($table->User) ? $table->User->email :  '';
            })
            ->addColumn('fechadesde',function($table){
                return $table->fecha_desde->format('d/m/Y');
            })
            ->addColumn('estadoFormat',function($table){
                return ($table->estado==1)? 'En Curso' : 'Cerrado';
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
