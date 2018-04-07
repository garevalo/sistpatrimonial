<?php

namespace App\Http\Controllers;

use App\Http\Requests\SgMessageRequest;
use App\Subgerencia;
use App\Gerencia;


class SubgerenciaController extends Controller
{

    public function index()
    {
        $subgerencias = Subgerencia::all();
        $gerencias = Gerencia::all()->pluck('gerencia','idgerencia');
        //dd($gerencias);
        return view('subgerencia.index',['subgerencias'=>$subgerencias,'gerencias'=>$gerencias]);

    }

    public function create()
    {
        $gerencias = Gerencia::all();
        return view('subgerencia.create',compact('gerencias'));
    }


    public function store(SgMessageRequest $request)
    {
        Subgerencia::create($request->all());

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
        $gerencias = Gerencia::all();
        return view("subgerencia.edit",['subgerencia'=>$subgerencia,'gerencias'=>$gerencias]);
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
