<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Pedido;
use App\ConteoInventario;
use App\inventario;
use DB;


class ReporteController extends Controller
{
    
    public function nivelcumplimiento()
    {
        return view('reporte.nivelcumplimiento');
    }

    public function index(){

    }


    public function nivelCumplimientoPdf(Request $request){

        $pedidos = DB::select(
                    DB::raw("SELECT 
                            DATE(i.updated_at)  fecha,
                            count((SELECT a1.idarticulos FROM articulos a1 where i.idarticulos =  a1.idarticulos)) solicitados,
                            count((SELECT a2.idarticulos FROM articulos a2 where i.idarticulos =  a2.idarticulos and a2.estado_articulo=2 )) entregados
                            FROM articulos i
                            WHERE DATE(i.updated_at) 
                            BETWEEN DATE('".Carbon::createFromFormat('d/m/Y', $request->desde)."') 
                                and DATE('".Carbon::createFromFormat('d/m/Y', $request->hasta)."')   
                        GROUP BY fecha"));
        
       // dd($pedidos);

        $data = array(
            'desde' => $request->desde,
            'hasta' => $request->hasta
        );

        $pdf = PDF::loadView('reporte.pdf.nivelcumplimiento',compact('pedidos','data'));
        return $pdf->stream('Reporte.pdf');

    }



    public function nivelexactitud()
    {
        return view('reporte.nivelexactitud');
    }


    public function nivelExactitudPdf(Request $request){

        $conteo = DB::select(DB::raw("select 
                    i.fecha_desde fecha,
                    count(i.fecha_desde),
                    (select count(ci.fecha_conteo) from conteo_inventarios ci where i.fecha_desde = date(ci.fecha_conteo) ) almacenada,
                    (select count(ci2.fecha_conteo) from conteo_inventarios ci2 where i.fecha_desde = date(ci2.fecha_conteo) and ci2.situacion=1) referencia
                    ,(select GROUP_CONCAT(i2.centrocosto SEPARATOR ' - ') from inventarios i2 where i2.fecha_desde = i.fecha_desde) centro_costos
                     from inventarios i
                    where i.fecha_desde between date('".Carbon::createFromFormat('d/m/Y', $request->desde)."') and date('".Carbon::createFromFormat('d/m/Y', $request->hasta)."')
                    group by fecha"));

        $data = array(
            'desde' => $request->desde,
            'hasta' => $request->hasta
        );

        $pdf = PDF::loadView('reporte.pdf.nivelexactitud',compact('conteo','data'));
        return $pdf->stream('ReporteExactitud.pdf');
    }

    public function inventario()
    {
        $years = collect(range(date('Y')-10,date('Y')))
                ->map(function ($item, $key) {
                    return ['key'=>$item,'val'=>$item];
                })
                ->pluck('key','val')
                ->reverse()
                ->toArray();

        return view('reporte.reporteinventario',compact('years'));
    }


    public function inventarioPdf(Request $request){
       
        $resultConciliado = ConteoInventario::where('situacion',1)
                                ->whereYear('fecha_conteo',$request->year)
                                ->with('Inventario.CentroCosto','bien.catalogo')
                                ->get();

        $resultFaltante = ConteoInventario::where('situacion',2)
                                ->whereYear('fecha_conteo',$request->year)
                                ->with('Inventario.CentroCosto','bien.catalogo')
                                ->get();                                  
        $year = $request->year;
        //dd($resultConciliado);                            

        $pdf = PDF::loadView('reporte.pdf.inventario',compact('resultFaltante','resultConciliado','year'));
        return $pdf->stream('ReporteInventario.pdf');
        //return view('reporte.pdf.inventario',compact('resultFaltante','resultConciliado'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}
