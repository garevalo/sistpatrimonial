<?php

namespace App\Http\Controllers;

use App\Http\Requests\SgMessageRequest;
use App\Subgerencia;
use App\CentroCosto;
use DB;


class SubgerenciaController extends Controller
{

    public function index()
    {
        $subgerencias = Subgerencia::all();
        //dd($gerencias);
        return view('subgerencia.index',['subgerencias'=>$subgerencias]);

    }

    public function create()
    {
        
        return view('subgerencia.create');
    }


    public function store(SgMessageRequest $request)
    {

        DB::transaction(function () use ($request) {
            Subgerencia::create($request->all());
            CentroCosto::create(["codcentrocosto"=>$request->centrocosto,'centrocosto'=>$request->subgerencia]);
        });


       return redirect()->route('subgerencia.index');
    }

    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subgerencia = Subgerencia::FindOrFail($id);
        
        return view("subgerencia.edit",['subgerencia'=>$subgerencia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SgMessageRequest $request, $id)
    {

        Subgerencia::FindOrFail($id)->update($request->all());

        return redirect()->route('subgerencia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        Subgerencia::FindOrFail($id)->delete();

        return redirect()->route('subgerencia.index');
    }
}
