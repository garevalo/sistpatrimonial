<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Articulo;
use App\CentroCosto;
use App\Personal;
use Datatables;
use App\Http\Requests\PedidoRequest;

class PedidoController extends Controller
{

    const REDIRECT = "pedido.index";
    const MODULO   = "pedido";
    const TITLEMOD = 'Pedido';

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
        $table = new Pedido;

        $centrocostos = CentroCosto::all()->pluck('centrocosto','codcentrocosto');
        $personales = Personal::all()->pluck('FullName','idpersonal');

        return view(self::MODULO.'.create',compact('modulo','table','titulomod','centrocostos','personales'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PedidoRequest $request)
    {



        $idpedido = Pedido::insertGetId([
            
            'cc_solicitante'=> $request->cc_solicitante,
            'cc_destino'    => $request->cc_destino,
            'responsable'    => $request->responsable,
            'estado_pedido'  => 1
        ]);

        if($idpedido){

            foreach ($request->cantidad as $key => $value) {
                Articulo::create([
                    "cantidad"          => $request->cantidad[$key],
                    "umedida"           => $request->umedida[$key],
                    "descripcion"       => $request->descripcion[$key],
                    "estado_articulo"   => '1',
                    "idpedido"          => $idpedido
                ]);
            }
        }

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
        
        $estados        =   array(1=>'Activo',2=>'Inactivo');

        $pedido = Pedido::with('centroCostoSolicitante','CentroCostoDestino','PersonalResponsable','articulo')->FindOrFail($id);

       // dd($pedido);

        return view(self::MODULO.'.show',compact('pedido'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $table = Pedido::FindOrFail($id);
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;

        $centrocostos = CentroCosto::all()->pluck('centrocosto','codcentrocosto');
        $personales = Personal::all()->pluck('FullName','idpersonal');

        return view(self::MODULO.".edit",compact('table','modulo','titulomod','centrocostos','personales'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PedidoRequest $request, $id)
    {
        GrupoGenerico::FindOrFail($id)->update($request->all());
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
        //
    }

    public function atencion($id=null){


        $centrocostos = CentroCosto::all()->pluck('centrocosto','codcentrocosto');
        $personales = Personal::all()->pluck('FullName','idpersonal');

        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;

        $table = Pedido::with('centroCostoSolicitante','CentroCostoDestino','PersonalResponsable','articulo')->FindOrFail($id);

        return view(self::MODULO.'.attend',compact('titulomod','modulo','table','centrocostos','personales'));

    }

    public function alldata(){

        return Datatables::of(Pedido::with('centroCostoSolicitante','CentroCostoDestino','PersonalResponsable','articulo')->get()  )
            
            ->addColumn('solicitante',function($field){
                return  $field->centroCostoSolicitante->codcentrocosto .' - '. $field->centroCostoSolicitante->centrocosto;
            })

            ->addColumn('destino',function($field){
                return  $field->CentroCostoDestino->codcentrocosto .' - '. $field->CentroCostoDestino->centrocosto;
            })

            ->addColumn('responsable',function($field){
                return  $field->PersonalResponsable->FullName;
            })

            ->addColumn('estado',function($field){
                if($field->estado_pedido == 1 ){
                    return 'Solicitado';
                }else{
                    return 'Atendido';
                }
            })

            ->addColumn('edit',function($field){
                return '<a href="'.route(self::MODULO.'.edit',$field->idpedido).'" class="btn btn-primary btn-xs">Editar</a>
                    <a href="'.route(self::MODULO.'.show',$field->idpedido).'" class="btn btn-info btn-xs">Ver</a>
                    <a href="'.route(self::MODULO.'.edit',$field->idpedido).'" class="btn btn-danger btn-xs">Eliminar</a>
                    <a href="'.route('atencion',$field->idpedido).'" class="btn btn-success btn-xs">Atender </a>
                    ' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
