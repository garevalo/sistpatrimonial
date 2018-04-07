<?php

namespace App\Http\Controllers;

use App\Gerencia;
use App\Http\Requests\PersonalRequest;
use App\Personal;
use App\Cargo;
use App\Sede;
use App\Subgerencia;


class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    const MODULO = "Personal";
    const REDIRECT = "personal.index";

    public function index()
    {

        $personals = Personal::with('cargo','subgerencia','gerencia','sede')->get();
        $modulo = "Personal";

        return view('personal.index',compact('modulo','personals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cargos = Cargo::all();
        $sedes = Sede::all();
        $gerencias = Gerencia::all();
        $subgerencias = Subgerencia::all();
        $modulo = "Personal";

        return view('personal.create',compact('modulo','cargos','subgerencias','sedes','gerencias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PersonalRequest $request)
    {
        Personal::create($request->all());
        return redirect()->route('personal.index');
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
        $personal = Personal::FindOrFail($id);
        $sedes = Sede::all();
        $cargos = Cargo::all();
        $subgerencias = Subgerencia::all();
        $gerencias = Gerencia::all();
        return view("personal.edit",['personal'=>$personal,
                                            'sedes'=>$sedes,
                                            'subgerencias'=>$subgerencias,
                                            'gerencias'=>$gerencias,
                                            'cargos'=>$cargos,
                                            'modulo'=>self::MODULO]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalRequest $request, $id)
    {
        Personal::FindOrFail($id)->update($request->all());

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
        Personal::FindOrFail($id)->delete();

        return redirect()->route(self::REDIRECT);
    }
}
