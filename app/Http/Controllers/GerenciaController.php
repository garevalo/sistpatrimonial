<?php

namespace App\Http\Controllers;

use App\Gerencia;
use App\Http\Requests\GerenciaRequest;
use App\CentroCosto;
use DB;

class GerenciaController extends Controller
{
    const REDIRECT = "gerencia.index";
    const MODULO = "Gerencia";

    public function index()
    {

        $gerencias = Gerencia::all();

        return view('gerencia.index',compact('gerencias','modulo'));
    }


    public function create()
    {
        return view('gerencia.create');
    }


    public function store(GerenciaRequest $request)
    {
        DB::transaction(function () use ($request) {
            Gerencia::create($request->all());
            CentroCosto::create(["codcentrocosto"=>$request->centrocosto,'centrocosto'=>$request->gerencia]);
        });
        

        return redirect()->route(self::REDIRECT);
    }


    public function show($id)
    {
        return $id;
    }


    public function edit($id)
    {
        $gerencia = Gerencia::FindOrFail($id);
        return view("gerencia.edit",['gerencia'=>$gerencia,'modulo'=>self::MODULO]);
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