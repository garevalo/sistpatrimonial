<?php

namespace App\Http\Controllers;

use App\ClaseGenerico;
use App\GrupoGenerico;
use Datatables;
use App\Http\Requests\ClaseGenericoRequest;

class ClaseGenericoController extends Controller
{

    const REDIRECT = "clasegenerico.index";
    const MODULO   = "claseGenerico";
    const TITLEMOD = 'Clase Genérica';

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
        $table = new ClaseGenerico;
        $grupos = GrupoGenerico::all()->pluck('grupo_generico','cod_grupo_generico');

        return view(self::MODULO.'.create',compact('modulo','table','titulomod','grupos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClaseGenericoRequest $request)
    {
        ClaseGenerico::create($request->all());
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = ClaseGenerico::FindOrFail($id);
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;

        $grupos = GrupoGenerico::all()->pluck('grupo_generico','cod_grupo_generico');
        return view(self::MODULO.".edit",compact('table','modulo','titulomod','grupos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClaseGenericoRequest $request, $id)
    {
        ClaseGenerico::FindOrFail($id)->update($request->all());
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

    public function getClasesByGrupo($id=null){

        return  ClaseGenerico::where('cod_grupo_generico',$id)->get();

    }

    public function alldata(){

        return Datatables::of(ClaseGenerico::with('GrupoGenericos')->get())
            ->addColumn('edit',function($table){
                return '<a href="'.route('clasegenerico.edit',$table->idclasegenerico).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })

            ->addColumn('grupo_generico',function($table){
               return  (isset($table->GrupoGenericos))? $table->GrupoGenericos->cod_grupo_generico .' - '. $table->GrupoGenericos->grupo_generico : '';
            })

            ->rawColumns(['edit'])
            ->make(true);

    }
}
