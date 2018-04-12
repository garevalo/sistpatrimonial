<?php

namespace App\Http\Controllers;

use App\Adquisicion;
use Datatables;
use App\Http\Requests\AdquisicionRequest;

class AdquisicionController extends Controller
{

    const REDIRECT = "adquisicion.index";
    const MODULO = "adquisicion";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $modulo = self::MODULO;
        return view(self::MODULO.'.index',compact('modulo'));
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
    public function store(AdquisicionRequest $request)
    {
        Adquisicion::create($request->all());
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
        $adquisicion = Adquisicion::FindOrFail($id);
        $modulo = self::MODULO;
        return view(self::MODULO.".edit",compact('adquisicion','modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdquisicionRequest $request, $id)
    {
        Adquisicion::FindOrFail($id)->update($request->all());
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
        Adquisicion::FindOrFail($id)->delete();
        return redirect()->route(self::MODULO.'.index');
    }

    public function alldata(){

        return Datatables::of(Adquisicion::all())
            ->addColumn('edit',function($adquisicion){
                return '<a href="'.route('adquisicion.edit',$adquisicion->idadquisicion).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
