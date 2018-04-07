<?php

namespace App\Http\Controllers;

use App\Gerencia;
use App\Http\Requests\GerenciaRequest;
use App\Sede;

class GerenciaController extends Controller
{
    const REDIRECT = "gerencia.index";
    const MODULO = "Gerencia";

    public function index()
    {

        $gerencias = Gerencia::all();
        $sedes = Sede::all()->pluck('sede','idsede');

        return view('gerencia.index',compact('gerencias','sedes','modulo'));
    }


    public function create()
    {
        $sedes = Sede::all();
        return view('gerencia.create',compact('sedes'));
    }


    public function store(GerenciaRequest $request)
    {

        Gerencia::create($request->all());
        return redirect()->route(self::REDIRECT);
    }


    public function show($id)
    {
        return $id;
    }


    public function edit($id)
    {
        $gerencia = Gerencia::FindOrFail($id);
        $sedes = Sede::all();
        return view("gerencia.edit",['gerencia'=>$gerencia,'sedes'=>$sedes,'modulo'=>self::MODULO]);
    }


    public function update(GerenciaRequest $request, $id)
    {

        Gerencia::FindOrFail($id)->update($request->all());

        return redirect()->route(self::REDIRECT);
    }


    public function destroy($id)
    {

        Gerencia::FindOrFail($id)->delete();

        return redirect()->route(self::REDIRECT);
    }
}