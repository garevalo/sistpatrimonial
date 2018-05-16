<?php

namespace App\Http\Controllers;

use App\CentroCosto;
use App\Gerencia;
use App\Subgerencia;
use App\Local;
Use App\Personal;
use Datatables;
use App\Http\Requests\CentroCostoRequest;

class CentroCostoController extends Controller
{

    const REDIRECT = "centrocosto.index";
    const MODULO   = "centrocosto";
    const TITLEMOD = 'Centro Costo';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;
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
        $table = new CentroCosto;
        
        $gerencias = Gerencia::all()->pluck('gerencia','idgerencia');
        $subgerencias = Subgerencia::all()->pluck('subgerencia','idsubgerencia');
        $locales = Local::all()->pluck('local','idlocal');
        $personales = Personal::all()->pluck('FullName','idpersonal');

        return view(self::MODULO.'.create',compact('modulo','table','titulomod','gerencias','subgerencias','locales','locales','personales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CentroCostoRequest $request)
    {
        CentroCosto::create($request->all());
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
        $table = CentroCosto::FindOrFail($id);
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;

        $gerencias = Gerencia::all()->pluck('gerencia','idgerencia');
        $subgerencias = Subgerencia::all()->pluck('subgerencia','idsubgerencia');
        $locales = Local::all()->pluck('local','idlocal');
        $personales = Personal::all()->pluck('FullName','idpersonal');
        return view(self::MODULO.'.edit',compact('modulo','table','titulomod','gerencias','subgerencias','locales','locales','personales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CentroCostoRequest $request, $id)
    {
        CentroCosto::FindOrFail($id)->update($request->all());
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

        return Datatables::of(CentroCosto::with('gerencia','subgerencia','local','personal')->get())
            ->addColumn('edit',function($table){
                return '<a href="'.route('centrocosto.edit',$table->id).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->addColumn('local',function($field){
                return (isset($field->local->local)) ? $field->local->local : '' ;
            })
            ->addColumn('personal',function($field){
                return (isset($field->personal->FullName)) ? $field->personal->FullName : '' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
