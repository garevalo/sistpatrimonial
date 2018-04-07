<?php

namespace App\Http\Controllers;
use App\Rol;
use Datatables;
use App\Http\Requests\RolRequest;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Rol::all();
        return view('rol.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RolRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolRequest $request)
    {
        Rol::create($request->all());
        return redirect()->route('rol.index');
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
        $rol = Rol::FindOrFail($id);
        return view("rol.edit",compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RolRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolRequest $request, $id)
    {
        Rol::FindOrFail($id)->update($request->all());
        return redirect()->route('rol.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rol::FindOrFail($id)->delete();
        return redirect()->route('rol.index');
    }

    public function alldata(){

        return Datatables::of(Rol::all())
            ->addColumn('edit',function($rol){
                return '<a href="'.route('rol.edit',$rol->idrol).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
