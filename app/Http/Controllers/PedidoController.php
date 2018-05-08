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
                'estado_pedido'=>'1',
                'cc_solicitante'=> $request->cc_solicitante,
                'cc_destino'    => $request->cc_destino,
                'responsable'    => $request->responsable,
            ]);
            if($idpedido){
                $hardware = Articulo::create([
                    "id_activo_hardware" => $idactivo,
                    "idtipo_hardware" => $request->idtipo_hardware,
                    "marca" => $request->marca,
                    "modelo" => $request->modelo,
                    "num_serie" => $request->num_serie,
                    "cod_inventario" => $request->cod_inventario,
                    "estado" => $request->estado,
                    "fecha_adquisicion" => Carbon::createFromFormat('d/m/Y', $request->fecha_adquisicion),
                    "descripcion"   => $request->descripcion,
                    "tipo" => $request->tipo,
                    "codigo_patrimonial" => $request->codigo_patrimonial
                     ]);
            }


        Pedido::create($request->all());
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
        $table = Pedido::FindOrFail($id);
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

    public function alldata(){

        return Datatables::of(Pedido::all())
            ->addColumn('edit',function($field){
                return '<a href="'.route(self::MODULO.'.edit',$field->idpedido).'" class="btn btn-primary btn-sm">Editar</a>' ;
            })
            ->rawColumns(['edit'])
            ->make(true);

    }
}
