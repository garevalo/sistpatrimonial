<?php

namespace App\Http\Controllers;

use App\Http\Requests\SoftwareRequest;
use App\Software;
use App\TipoSoftware;
use App\Activo;
use Carbon\Carbon;

class SoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $softwares = Software::with('tiposoftware')->get();
        return view("software.index",compact('softwares'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tiposoftwares = TipoSoftware::all();
        $estados = array(1=>'Bueno',2=>'Regular',3=>'Malo');
        return view("software.create",compact('tiposoftwares','estados'));
    }


    public function store(SoftwareRequest $request)
    {
        $idactivo = Activo::insertGetId(['fecha_adquisicion'=> Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
            'tipo_activo'=>'2']);

        if($idactivo){
            $software = Software::create([
            "id_activo_software" => $idactivo,
            "nombre_software" => $request->nombre_software,
            "idtipo_software" => $request->idtipo_software,
            "arquitectura" => $request->arquitectura,
            "service_pack" => $request->service_pack,
            "fecha_adquisicion" => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
            "licencia"=> $request->licencia]);
        }
       

        return redirect()->route('software.index');
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

    public function edit($id)
    {
        $software = Software::FindOrFail($id);
        $tiposoftwares = TipoSoftware::all();
        $estados = array(1=>'Bueno',2=>'Regular',3=>'Malo');

        return view('software.edit',compact('tiposoftwares','estados','software'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SoftwareRequest $request, $id)
    {
        Software::FindOrFail($id)->update(
            [
                "idtipo_software" => $request->idtipo_software,
                "nombre_software" => $request->nombre_software,
                "arquitectura" => $request->arquitectura,
                "service_pack" => $request->service_pack,
                "fecha_adquisicion" => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                "licencia"=> $request->licencia
            ]

        );

        return redirect()->route('software.index');
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
}
