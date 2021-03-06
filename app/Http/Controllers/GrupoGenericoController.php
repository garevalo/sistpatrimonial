<?php

namespace App\Http\Controllers;

use App\GrupoGenerico;
use Datatables;
use App\Http\Requests\GrupoGenericoRequest;

class GrupoGenericoController extends Controller
{

    const REDIRECT = "grupogenerico.index";
    const MODULO   = "grupoGenerico";
    const TITLEMOD = 'Grupo Genérico';
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
        $table = new GrupoGenerico;

        return view(self::MODULO.'.create',compact('modulo','table','titulomod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GrupoGenericoRequest $request)
    {
        
        GrupoGenerico::create($request->all());
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
        $table = GrupoGenerico::FindOrFail($id);
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
    public function update(GrupoGenericoRequest $request, $id)
    {
        GrupoGenerico::FindOrFail($id)->update($request->all());
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

        return Datatables::of(GrupoGenerico::all())
            ->addColumn('edit',function($grupogenerico){
                return '<a href="'.route('grupogenerico.edit',$grupogenerico->idgrupogenerico).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
