<?php

namespace App\Http\Controllers;

use App\Http\Requests\HardwareRequest;
use App\TipoHardware;
use App\Hardware;
use App\Activo;
use Carbon\Carbon;
use DB;
use Datatables;

class HardwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hardwares = Hardware::with('tipohardware','activo')->get();
        return view('hardware.index',compact('hardwares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipohardware = TipoHardware::all();
        $estados = array(1=>'Bueno',2=>'Regular',3=>'Malo');
        $estados_activos = array(1=>'Activo',2=>'Baja',3=>'Devuelto');
        return view('hardware.create',compact('tipohardware','estados','estados_activos'));
    }

    public function store(HardwareRequest $request)
    {

        $idactivo = Activo::insertGetId(['fecha_adquisicion'=> Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
            'tipo_activo'=>'1',
            'estado_activo'=> $request->estado_activo,
            'orden_compra'=> $request->orden_compra
        ]);

        if($idactivo){
            $hardware = Hardware::create([
                "id_activo_hardware" => $idactivo,
                "idtipo_hardware" => $request->idtipo_hardware,
                "marca" => $request->marca,
                "modelo" => $request->modelo,
                "num_serie" => $request->num_serie,
                "cod_inventario" => $request->cod_inventario,
                "estado" => $request->estado,
                "fecha_adquisicion" => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                "descripcion"   => $request->descripcion,
                "tipo" => $request->tipo,
                "codigo_patrimonial" => $request->codigo_patrimonial
                 ]);
        }

        
        return redirect()->route('hardware.index');
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
        $hardware = Hardware::with('activo')->where('idhardware',$id)->get();
        $hardware = $hardware[0];
        //dd($hardware);
        $tipohardwares = TipoHardware::all();

        $estados = array(1=>'Bueno',2=>'Regular',3=>'Malo');
        $estados_activos = array(1=>'Activo',2=>'Baja',3=>'Devuelto');
        return view('hardware.edit',compact('tipohardwares','estados','hardware','estados_activos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HardwareRequest $request, $id)
    {
        //dd($request->all());
        Activo::FindOrFail($request->idactivo)->update([
            'fecha_adquisicion'=> Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
            'estado_activo'=> $request->estado_activo,
            'orden_compra'=> $request->orden_compra
            ]);

        Hardware::FindOrFail($id)->update([
                "idtipo_hardware" => $request->idtipo_hardware,
                "marca" => $request->marca,
                "modelo" => $request->modelo,
                "num_serie" => $request->num_serie,
                "cod_inventario" => $request->cod_inventario,
                "estado" => $request->estado,
                "fecha_adquisicion" => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                "descripcion" => $request->descripcion,
                "codigo_patrimonial" =>$request->codigo_patrimonial,
            ]);

        return redirect()->route('hardware.index');
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

    public function getalldata(){

        $hardware = Hardware::with('tipohardware','activo')->get();

        return Datatables::of( $hardware )
        ->addColumn('estadohardware',function($hardware){
            if($hardware->estado==1)
                return '<span class="label label-success">Bueno</span>';
            elseif($hardware->estado==2)
                return '<span class="label label-danger">Regular</span>';
            else
                return '<span class="label label-warning">Malo </span>';
        })
        ->addColumn('estadoactivo',function($hardware){
            if($hardware->activo->estado_activo==1)
                return '<span class="label label-success">Activo</span>';
            elseif($hardware->activo->estado_activo==2)
                return '<span class="label label-danger">De Baja</span>';
            else
                return '<span class="label label-warning">Devuelto </span>';
        })
        ->addColumn('edit',function($hardware){
                return '<a href="'.route('hardware.edit',$hardware->idhardware).'" class="btn btn-primary btn-sm">Editar</a>' ;
        })
        ->rawColumns(['edit','estadohardware','estadoactivo'])
        ->make(true);
    }
}
