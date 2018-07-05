<?php



namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Carbon\Carbon;
use App\Pedido;
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
                            DATE_FORMAT(i.created_at,'%d/%m/%Y') fecha,
                            count((SELECT a1.idarticulos FROM articulos a1 where i.idarticulos =  a1.idarticulos)) solicitados,
                            count((SELECT a2.idarticulos FROM articulos a2 where i.idarticulos =  a2.idarticulos and a2.estado_articulo=2 )) entregados
                            FROM articulos i
                            WHERE DATE(i.created_at) 
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
                    (select count(ci.fecha_conteo) from conteo_inventarios ci where i.fecha_desde = date(ci.created_at) ) almacenada,
                    (select count(ci2.fecha_conteo) from conteo_inventarios ci2 where i.fecha_desde = date(ci2.created_at) and ci2.situacion=1) referencia
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
