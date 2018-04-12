<?php

namespace App\Http\Controllers;

use App\Color;
use Datatables;
use App\Http\Requests\ColorRequest;

class ColorController extends Controller
{

    const REDIRECT = "color.index";
    const MODULO = "color";
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
    public function store(ColorRequest $request)
    {
        Color::create($request->all());
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
        $color = Color::FindOrFail($id);
        $modulo = self::MODULO;
        return view(self::MODULO.".edit",compact('color','modulo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ColorRequest $request, $id)
    {
        Color::FindOrFail($id)->update($request->all());
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
        Color::FindOrFail($id)->delete();
        return redirect()->route(self::MODULO.'.index');
    }

    public function alldata(){

        return Datatables::of(Color::all())
            ->addColumn('edit',function($color){
                return '<a href="'.route('color.edit',$color->idcolor).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
