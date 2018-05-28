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


        $pedidos = DB::select(DB::raw('SELECT count(date(created_at)) cantidad,date(created_at) fecha  FROM pedidos 
                                        where date(created_at) is not null and
                                        date(created_at) between "'.Carbon::createFromFormat('d/m/Y', $request->desde).'" and "'.Carbon::createFromFormat('d/m/Y', $request->hasta).'"
                                        group by date(created_at)'));

        $pedidosentregados = DB::select(DB::raw('SELECT count(date(fecha_entrega)) cantidad,date(fecha_entrega) fecha FROM pedidos 
                                        where date(fecha_entrega) is not null and estado_pedido=2 and
                                        date(fecha_entrega) between "'.Carbon::createFromFormat('d/m/Y', $request->desde).'" and "'.Carbon::createFromFormat('d/m/Y', $request->hasta).'"
                                        group by date(fecha_entrega)'));

        /*dump($pedidos); 
        dump($pedidosentregados);
        dd( array_merge_recursive ( (array) $pedidos , (array) $pedidosentregados));*/

        $data = array(
            'desde' => $request->desde,
            'hasta' => $request->hasta
        );

        $pdf = PDF::loadView('reporte.pdf.nivelcumplimiento',compact('pedidos','pedidosentregados','data'));
        return $pdf->stream('Reporte.pdf');
        //return view('reporte.pdf.nivelcumplimiento',$data);
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
