<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Datatables;
use App\Http\Requests\ProveedorRequest;

class ProveedorController extends Controller
{

    const REDIRECT = "proveedor.index";
    const MODULO   = "proveedor";
    const TITLEMOD = 'Proveedor';


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;
        return view(self::MODULO.'.index',compact('modulo','titulomod'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;
        $table = new Proveedor;

        return view(self::MODULO.'.create',compact('modulo','table','titulomod'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorRequest $request)
    {
        Proveedor::create($request->all());
        return redirect()->route(self::REDIRECT);
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
        $table = Proveedor::FindOrFail($id);
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;

        return view(self::MODULO.".edit",compact('table','modulo','titulomod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorRequest $request, $id)
    {
        Proveedor::FindOrFail($id)->update($request->all());
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
        print($id);
    }

    public function alldata(){
        
        
        return Datatables::of(Proveedor::all())
            ->addColumn('edit',function($table){
                $csrf    = csrf_token();
                $delete = '<form method="post" action="'.route(self::MODULO.'.destroy',$table->idproveedor).'">
                    <input type="hidden" name="_token" value="'.$csrf.'">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="submit" value="Eliminar" class="btn btn-danger btn-xs" onclick="borrar()" >
                </form>';

                return '<a href="'.route('proveedor.edit',$table->idproveedor).'" class="btn btn-primary btn-xs">Editar</a>'  ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
