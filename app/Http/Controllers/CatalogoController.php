<?php

namespace App\Http\Controllers;

use App\Catalogo;
use App\GrupoGenerico;
use App\ClaseGenerico;

use App\Http\Requests\CatalogoRequest;
use Illuminate\Http\Request;
use Datatables;

class CatalogoController extends Controller
{

    const REDIRECT = "catalogo.index";
    const MODULO = "catalogo";
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //echo $method = $request->path();
        $catalogos = Catalogo::all();
        $modulo = self::MODULO;
        return view(self::MODULO.'.index',compact('catalogos','modulo'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modulo = self::MODULO;
        $estados = array(1=>'Activo',2=>'Inactivo');
        $grupos = GrupoGenerico::all()->pluck('grupo_generico','cod_grupo_generico');

        $clases = ClaseGenerico::all()->pluck('clase_generico','cod_clase_generico');

        return view(self::MODULO.'.create',compact('modulo','estados','grupos','clases'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CatalogoRequest $request)
    {
        Catalogo::create($request->all());
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
        $catalogo = Catalogo::FindOrFail($id);
        $modulo = self::MODULO;
        $estados = array(1=>'Activo',2=>'Inactivo');

        $grupos = GrupoGenerico::all()->pluck('grupo_generico','cod_grupo_generico');

        $clases = ClaseGenerico::all()->pluck('clase_generico','cod_clase_generico');

        return view(self::MODULO.".edit",compact('catalogo','modulo','estados','grupos','clases'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CatalogoRequest $request, $id)
    {
        Catalogo::FindOrFail($id)->update($request->all());
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
        Catalogo::FindOrFail($id)->delete();
        return redirect()->route(self::MODULO.'.index');
    }

    public function alldata(){

        return Datatables::of(Catalogo::all())
            ->addColumn('edit',function($catalogo){
                return '<a href="'.route('catalogo.edit',$catalogo->idcatalogo).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->addColumn('estado',function($catalogo){
                if($catalogo->idestado==1)
                    return '<span class="label label-info">Activo</span>';
                elseif($catalogo->idestado==2)
                    return '<span class="label label-warning">Inactivo</span>';

            })
            ->rawColumns(['edit','estado'])
            ->make(true);

    }

    public function items(Request $request,$id=null){

        $term       =   $request->term ? : ''; 
        $catalogo   =   Catalogo::where('denom_catalogo', 'like', $term.'%')->get();
        $result     =   array();

        foreach ($catalogo as $key => $value) {
            if( $id==$value->codcatalogo ){
                $result[]  = array('id' => $value->codcatalogo, 'text' => $value->denom_catalogo,'term' => $value->denom_catalogo , 'codcatalogo' => $value->codcatalogo,"selected"=> true);  
            }else{
                $result[]  = array('id' => $value->codcatalogo, 'text' => $value->denom_catalogo,'term' => $value->denom_catalogo , 'codcatalogo' => $value->codcatalogo);  
            }
            
        }

        return response()->json(['results' => $result ]) ;
    }
}
