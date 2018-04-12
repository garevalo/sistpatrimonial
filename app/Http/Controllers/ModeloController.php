<?php

namespace App\Http\Controllers;

use App\Modelo;
use Datatables;
use App\Http\Requests\ModeloRequest;

class ModeloController extends Controller
{

    const REDIRECT = "modelo.index";
    const MODULO = "modelo";
    const MODELO = "Modelo";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modelos = Modelo::all();
        $modulo = self::MODULO;
        return view(self::MODULO.'.index',compact('modelos','modulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulo = self::MODULO;
        return view(self::MODULO.'.create',compact('modulo'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModeloRequest $request)
    {
        Modelo::create($request->all());
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
        $modelo = Modelo::FindOrFail($id);
        $modulo = self::MODULO;
        return view(self::MODULO.".edit",compact('modelo','modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModeloRequest $request, $id)
    {
        Modelo::FindOrFail($id)->update($request->all());
        return redirect()->route(self::MODULO.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Modelo::FindOrFail($id)->delete();
        return redirect()->route(self::MODULO.'.index');
    }

    public function alldata(){

        return Datatables::of(Modelo::all())
            ->addColumn('edit',function($modelo){
                return '<a href="'.route('modelo.edit',$modelo->idmodelo).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
