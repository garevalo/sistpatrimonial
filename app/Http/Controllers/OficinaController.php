<?php

namespace App\Http\Controllers;

use App\Oficina;
use App\Local;
use Datatables;
use App\Http\Requests\OficinaRequest;

class OficinaController extends Controller
{

    const REDIRECT = "oficina.index";
    const MODULO   = "oficina";
    const TITLEMOD = 'oficina';

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
        $table = new Oficina;
        $locales = Local::all()->pluck('local','idlocal');

        return view(self::MODULO.'.create',compact('modulo','table','titulomod','locales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OficinaRequest $request)
    {
        Oficina::create($request->all());
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
        $table = Oficina::FindOrFail($id);
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;

        $locales = Local::all()->pluck('local','idlocal');

        return view(self::MODULO.".edit",compact('table','modulo','titulomod','locales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OficinaRequest $request, $id)
    {
        Oficina::FindOrFail($id)->update($request->all());
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

        return Datatables::of(Oficina::with('local')->get())
            ->addColumn('edit',function($table){
                return '<a href="'.route('oficina.edit',$table->idoficina).'" class="btn btn-primary btn-xs">Editar</a>' ;
            })
            ->addColumn('local',function($table){
                return $table->local->local;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }

    public function getItemBy($model='Oficina',$by=null,$id=null,$with=null){

        $model = app( str_replace(" ","","App\ ").$model);
        
        if(!empty($with)){
            $result = $model::with($with)->where($by,$id)->get();
        }else{
            $result = $model::where($by,$id)->get();    
        }
        
        return response()->json($result);
    }
}
