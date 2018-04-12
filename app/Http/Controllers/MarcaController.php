<?php

namespace App\Http\Controllers;

use App\Marca;
use App\Http\Requests\MarcaRequest;
use Datatables;

class MarcaController extends Controller
{

    const REDIRECT = "marca.index";
    const MODULO   = "marca";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = Marca::all();
        $modulo = self::MODULO;

        return view(self::MODULO.'.index',compact('cargos','modulo'));
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
    public function store(MarcaRequest $request)
    {
        Marca::create($request->all());
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
        $marca = Marca::FindOrFail($id);
        $modulo = self::MODULO;
        return view(self::MODULO.".edit",compact('marca','modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarcaRequest $request, $id)
    {
        Marca::FindOrFail($id)->update($request->all());
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
        Marca::FindOrFail($id)->delete();
        return redirect()->route(self::MODULO.'.index');
    }

    public function alldata(){

        return Datatables::of(Marca::all())
            ->addColumn('edit',function($rol){
                return '<a href="'.route('marca.edit',$rol->idmarca).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    } 
}
