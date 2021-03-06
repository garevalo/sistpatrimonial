<?php

namespace App\Http\Controllers;

use App\Pedido;
use App\Articulo;
use App\CentroCosto;
use App\Personal;
use App\Local;
use App\Oficina;
use App\Bien;
use Datatables;
use Carbon\Carbon;
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
        $locales = Local::all()->pluck('local','idlocal');
        $oficinas = Oficina::all()->pluck('oficina','idoficina');

        return view(self::MODULO.'.create',compact('modulo','table','titulomod','centrocostos','personales','locales','oficinas'));
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
            'estado_pedido'  => 1,
            'created_at'    => Carbon::now()
        ]);

        if($idpedido){

            foreach ($request->descripcion as $key => $value) {
                Bien::FindOrFail($request->descripcion[$key])->update(['estado_pedido'=>2]);

                Articulo::create([
                    //"cantidad"          => $request->cantidad[$key],
                    //"umedida"           => $request->umedida[$key],
                    "idbien"       => $request->descripcion[$key],
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
        $estadoarticulo =   [1=> 'Solicitado',2 =>'Entregado',3 =>'No Entregado'];
        $pedido         =   Pedido::with('centroCostoSolicitante','CentroCostoDestino','PersonalResponsable','articulo.bien.catalogo')->FindOrFail($id);
        
        //dd($pedido);
        return view(self::MODULO.'.show',compact('pedido','estadoarticulo'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $centrocostos = CentroCosto::all()->pluck('centrocosto','codcentrocosto');
        $personales = Personal::all()->pluck('FullName','idpersonal');

        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;
        $estados = [1=>'Solicitado',2=>'Completo'];
        $estadoarticulo = [1=> 'Solicitado',2 =>'Entregado',3 =>'No Entregado'];
        $oficinas = Oficina::all()->pluck('oficina','idoficina');
        $table = Pedido::with('centroCostoSolicitante','CentroCostoDestino','PersonalResponsable','articulo.bien.catalogo')->FindOrFail($id);
        //dd($table);
        return view(self::MODULO.'.edit',compact('titulomod','modulo','table','centrocostos','personales','estados','estadoarticulo','oficinas'));
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
        /*GrupoGenerico::FindOrFail($id)->update($request->all());
        return redirect()->route(self::REDIRECT);*/
       // dd($request->all());

        Pedido::FindOrFail($id)->update([
            
            'cc_solicitante'=> $request->cc_solicitante,
            'cc_destino'    => $request->cc_destino,
            'responsable'    => $request->responsable
        ]);


        foreach ($request->descripcion as $key => $value) {
            Articulo::FindOrFail($key)->update([
                "idbien"       => $value,
            ]);
        }
        

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
        $oficinas = Oficina::all()->pluck('oficina','idoficina');
        $modulo = self::MODULO;
        $titulomod = self::TITLEMOD;
        $estados = [1=>'Solicitado',2=>'Completo'];
        $estadoarticulo = [1=> 'Solicitado',2 =>'Entregado',3 =>'No Entregado'];
        $table = Pedido::with('centroCostoSolicitante','CentroCostoDestino','PersonalResponsable','articulo.bien.catalogo')->FindOrFail($id);

        return view(self::MODULO.'.attend',compact('titulomod','modulo','table','centrocostos','personales','estados','estadoarticulo','oficinas'));
    }


    public function atencionStore(PedidoRequest $request,$id){

        //dd($request->all());

        Pedido::FindOrFail($id)->update([
            'estado_pedido' => $request->estado,
            'descripcion'   => $request->descripcion,
            'fecha_entrega' => Carbon::createFromFormat('d/m/Y', $request->fecha_entrega)  
        ]);


        foreach ($request->idarticulo as $key => $idarticulo) {
            Articulo::FindOrFail($idarticulo)->update([
                'estado_articulo' => $request->estado_articulo[$key],
                'updated_at'      => Carbon::createFromFormat('d/m/Y', $request->fecha_entrega)
            ]);
        }

        /*
        DB::transaction(function () use ($request) {
            
           $idtransferencia = Transferencia::insertGetId([
                'cc_origen'           => $request->centrocosto,
                'personal_origen'     => $request->idpersonal,

                'cc_destino'          => $request->cc_solicitante,
                'personal_destino'    => $request->responsable
            ]);

            foreach ($request->bien as $key => $bien) {
                Bien::FindOrFail($key)->update([
                    'centrocosto'=> $request->cc_solicitante,
                    'idpersonal' => $request->responsable
                ]); 

                Movimiento::create([
                    'idbien'            => $key,
                    'centrocosto'       => $request->centrocostodestino,
                    'idpersonal'        => $request->idpersonaldestino,
                    'desde_centrocosto' => $request->centrocosto,
                    'desde_personal'    => $request->idpersonal,
                    'fecha_movimiento'  => Carbon::now(),
                    'idtransferencia'   => $idtransferencia
                ]);
            }
            
        });*/

        return redirect()->route(self::REDIRECT);
    }

    public function alldata(){

        return Datatables::of(Pedido::with('centroCostoSolicitante','CentroCostoDestino','PersonalResponsable','articulo')->get()  )
            
            ->addColumn('solicitante',function($field){
                return  $field->centroCostoSolicitante->codcentrocosto .' - '. $field->centroCostoSolicitante->centrocosto;
            })

            ->addColumn('destino',function($field){
                return (isset($field->CentroCostoDestino->oficina))? $field->CentroCostoDestino->oficina : '';
            })

            ->addColumn('responsable',function($field){
                return  $field->PersonalResponsable->FullName;
            })

            ->addColumn('fechaentrega',function($field){
                return  date('d/m/Y',strtotime($field->fecha_entrega) );
            })    

            ->addColumn('estado',function($field){
                if($field->estado_pedido == 1 ){
                    return 'Solicitado';
                }else{
                    return 'Atendido';
                }
            })

            ->addColumn('edit',function($field){
                /*return '<a href="'.route(self::MODULO.'.edit',$field->idpedido).'" class="btn btn-primary btn-xs">Editar</a>
                    <a href="'.route(self::MODULO.'.show',$field->idpedido).'" class="btn btn-info btn-xs">Ver</a>
                    <a href="'.route(self::MODULO.'.edit',$field->idpedido).'" class="btn btn-danger btn-xs">Eliminar</a>
                    <a href="'.route('atencion',$field->idpedido).'" class="btn btn-success btn-xs">Atender </a>
                    ' ;*/

                return '<a href="'.route(self::MODULO.'.edit',$field->idpedido).'" class="btn btn-primary btn-xs">Editar</a>
                    <a href="'.route(self::MODULO.'.show',$field->idpedido).'" class="btn btn-info btn-xs">Ver</a>
                    <a href="'.route('atencion',$field->idpedido).'" class="btn btn-success btn-xs">Atender </a>' ;                    
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
