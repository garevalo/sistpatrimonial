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

        $pedidos = DB::select(DB::raw("SELECT 
                                        date_format(i.created_at,'%d/%m/%Y') fecha,
                                        count((select idbien from articulos ci where i.idbien =  ci.idbien limit 1 )) solicitados,
                                        count((select idbien from articulos ci where i.idbien =  ci.idbien and ci.estado_articulo=2 limit 1 )) entregados
                                    from articulos i
                                    where i.created_at between date('".Carbon::createFromFormat('d/m/Y', $request->desde)."') and date('".Carbon::createFromFormat('d/m/Y', $request->hasta)."')
                                    group by i.created_at"));
        
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
                    date_format(i.fecha_desde,'%d/%m/%Y') fecha,
                    (select count(idinventario) from conteo_inventarios ci where i.idinventario =  ci.idinventario) almacenada,
                    (select count(idinventario) from conteo_inventarios ci where i.idinventario =  ci.idinventario and ci.situacion=1) referencia
                     from inventarios i
                    where fecha_desde between date('".Carbon::createFromFormat('d/m/Y', $request->desde)."') and date('".Carbon::createFromFormat('d/m/Y', $request->hasta)."')
                    order by i.fecha_desde"));

        $data = array(
            'desde' => $request->desde,
            'hasta' => $request->hasta
        );
        $pdf = PDF::loadView('reporte.pdf.nivelexactitud',compact('conteo','data'));
        return $pdf->stream('ReporteExactitud.pdf');
        //return view('reporte.pdf.nivelexactitud',compact('conteo','data'));
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
