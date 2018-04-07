<?php

namespace App\Http\Controllers;

use App\Http\Requests\TiposoftwareRequest;
use App\TipoSoftware;
use Datatables;

class TipoSoftwareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("tiposoftware.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tiposoftware.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TiposoftwareRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TiposoftwareRequest $request)
    {
        TipoSoftware::create($request->all());
        return redirect()->route("tiposoftware.index");
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
        $tiposoftware =  TipoSoftware::FindOrFail($id);
        return view("tiposoftware.edit",compact('tiposoftware'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TiposoftwareRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TiposoftwareRequest $request, $id)
    {
        TipoSoftware::FindOrFail($id)->update($request->all());
        return redirect()->route('tiposoftware.index');
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

       return Datatables::of(TipoSoftware::all())->make(true);

    }
}
