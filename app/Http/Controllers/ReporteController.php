<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Excel;
use DB;
use Carbon\Carbon;
use App\Activo;
use App\Personals_activos;
use App\Sede;
use App\Gerencia;
use App\Subgerencia;
use App\Personal;

ini_set('max_execution_time', 180);

class ReporteController extends Controller
{

    public function ActivosObsoletos(){
       return view('reportes.frmactivosobsoletos');
    }

    public function ActivosObsoletosPdf(Request $request)
    {

       $activos = DB::select(DB::raw('select  idgerencia_personal,
            (select gerencia from gerencias g where g.idgerencia=p1.idgerencia_personal ) as gerencia,
            count(activos.idactivo) total_activos,            
            (
            select count(pa2.activos_id) from 
              (
                select activos_id, 
                (select personals_idpersonal from personals_activos b where a.activos_id=b.activos_id order by activos_id desc limit 1) personals_idpersonal
                    from personals_activos a
                    group by activos_id
                    order by activos_id desc
                ) pa2   
            join activos   on pa2.activos_id = activos.idactivo
            join hardwares h on activos.idactivo = h.id_activo_hardware
            join personals on pa2.personals_idpersonal = personals.idpersonal
            where (TIMESTAMPDIFF(YEAR,h.fecha_adquisicion , CURDATE()))>=4 and p1.idgerencia_personal = personals.idgerencia_personal and activos.tipo_activo=1
            ) activos_obsoletos
            from (
             select activos_id, 
            (select personals_idpersonal from personals_activos b where a.activos_id=b.activos_id order by activos_id desc limit 1) personals_idpersonal
            from personals_activos a
            group by activos_id
            order by activos_id desc
             ) pa
            join `activos` on `activos_id` = `activos`.`idactivo` 
            join personals p1 on pa.personals_idpersonal = p1.idpersonal
            where activos.tipo_activo=1 and activos.asignado=1
            group by p1.idgerencia_personal'));


        $data = array(
            'desde' => $request->desde,
            'hasta' => $request->hasta,
            'activos' => $activos,
        );



        $pdf = PDF::loadView('reportes.activosobsoletospdf',$data);
        return $pdf->stream('Reporte.pdf');
    }

    public function LicenciasPagadas()
    {
        return view('reportes.frmlicencias');

    }

    public function LicenciasPagadasPdf(Request $request)
    {
        $activos = DB::select(DB::raw('select  idgerencia_personal,
            (select gerencia from gerencias g where g.idgerencia=p1.idgerencia_personal ) as gerencia,
            count(activos.idactivo) licencias_usadas,            
            (
            select count(pa2.activos_id) 
            from 
                (
                select activos_id, 
                (select personals_idpersonal from personals_activos b where a.activos_id=b.activos_id order by activos_id desc limit 1) personals_idpersonal
                    from personals_activos a
                    group by activos_id
                    order by activos_id desc
                ) pa2
            join personals on pa2.personals_idpersonal = personals.idpersonal
            join softwares on id_activo_software = pa2.activos_id
            where  licencia=1 and p1.idgerencia_personal = personals.idgerencia_personal
            ) licencias_pagadas
            from (
                select activos_id, 
                (select personals_idpersonal from personals_activos b where a.activos_id=b.activos_id order by activos_id desc limit 1) personals_idpersonal
            from personals_activos a
            group by activos_id
            order by activos_id desc
             ) pa
            join `activos` on `activos_id` = `activos`.`idactivo` 
            join personals p1 on pa.personals_idpersonal = p1.idpersonal
            where activos.tipo_activo=2
            group by p1.idgerencia_personal'));

        //dd($activos);
        $data = array(
            'desde' => $request->desde,
            'hasta' => $request->hasta,
            'activos' => $activos,
        );

        $pdf = PDF::loadView('reportes.licenciapagadas',$data);
        return $pdf->stream();
    }


    public function ActivosOperativos(){

        $sedes = Sede::all();
        $gerencias = Gerencia::all();
        $subgerencias = Subgerencia::all();

        return view('reportes.FrmActivosOperativos',compact('sedes','gerencias','subgerencias'));

    }

    public function ActivosInoperativos(){

        $sedes = Sede::all();
        $gerencias = Gerencia::all();
        $subgerencias = Subgerencia::all();

        return view('reportes.FrmActivosInoperativos',compact('sedes','gerencias','subgerencias'));

    }

    public function ActivosOperativosProcesar(Request $request){

          $sede         = $request->idsede_personal;
          $gerencia     = $request->idgerencia_personal;
          $subgerencia  = $request->idsubgerencia_personal;
          $estado       = $request->estado; /* 1 operativo 2 inoperativo*/
          $exportar     = $request->exportar;

          $data['datos'] = $this->getActivosOperativos($sede,$gerencia,$subgerencia,$estado);
          $data['title'] = ($estado == 1)? 'Operativos': 'Inoperativos'; 
          //dd($data);

          if(!empty($data['datos'])){
            if($exportar==1){
               return $this->export('reportes.excel.ActivosOperativos',$data);
            } else{
                return $this->export('reportes.excel.ActivosOperativos',$data,'pdf');
            }
          }
          else{
            echo "<script>alert('No hay datos'); window.close();</script>";
          }
          

    }

    public function getActivosOperativos($sede=null,$gerencia=null,$subgerencia=null,$estado=1,$vencido=0){

        $sql = "select  idgerencia_personal,
            (select gerencia from gerencias g where g.idgerencia=p1.idgerencia_personal ) as gerencia,
            (select subgerencia from subgerencias sg where sg.idsubgerencia=p1.idsubgerencia_personal ) as subgerencia,
            (select sede from sedes s where s.idsede=p1.idsede_personal ) as sede,
            concat(p1.nombres,' ',p1.apellido_paterno,' ',p1.apellido_materno) personal, 

            (
             select tipo_hardwares.tipo_hardware from tipo_hardwares where id_tipo_hardware = h.idtipo_hardware
            ) tipo_hardware,

            pa.*,h.*
            from (
             select activos_id, 
            (select personals_idpersonal from personals_activos b where a.activos_id=b.activos_id order by activos_id desc limit 1) personals_idpersonal
            from personals_activos a
            group by activos_id
            order by activos_id desc
             ) pa
            join activos on activos_id = activos.idactivo
            join personals p1 on pa.personals_idpersonal = p1.idpersonal
            join hardwares h on h.id_activo_hardware = pa.activos_id
            where activos.tipo_activo=1
            ";

        $sqlwhere = '';     
        if($vencido==1){
            $sqlwhere.=" and (TIMESTAMPDIFF(YEAR,h.fecha_adquisicion , CURDATE()))>=4 ";
        }else{
            $sqlwhere .= " and activos.estado_activo={$estado}";
        }


        if(!empty($sede) )
            $sqlwhere .= " and p1.idsede_personal = {$sede}";

        if(!empty($gerencia) )
            $sqlwhere .= " and p1.idgerencia_personal = {$gerencia}";

        if(!empty($subgerencia) )
            $sqlwhere .= " and p1.idsubgerencia_personal = {$subgerencia}";

        //return $sql.$sqlwhere;  
        return $activos = DB::select(DB::raw($sql.$sqlwhere));

    }

    public function export($view=null,$data=null,$type="excel"){

        if($type=="pdf"){

            $pdf = PDF::loadView($view,array('data'=>$data));
            return $pdf->stream();

        } elseif($type=="excel"){
            Excel::create('reporte', function($excel) use ($view,$data) {
                $excel->sheet('reporte', function($sheet) use ($view,$data) {
                    //dd($activos);
                    $sheet->loadView($view,array('data'=>$data) );
                });
            })->export('xlsx');
        }
    }


    public function ActivosVencidos(){


        $sedes = Sede::all();
        $gerencias = Gerencia::all();
        $subgerencias = Subgerencia::all();

        return view('reportes.FrmActivosVencidos',compact('sedes','gerencias','subgerencias'));
        //return view('reportes.FrmActivosOperativos');

    }

    public function ActivosVencidosProcesar(Request $request){

          $sede         = $request->idsede_personal;
          $gerencia     = $request->idgerencia_personal;
          $subgerencia  = $request->idsubgerencia_personal;
          $exportar     = $request->exportar;

          $data = $this->getActivosOperativos($sede,$gerencia,$subgerencia,0,1);

          if(!empty($data)){
            if($exportar==1){
                $this->export('reportes.excel.ActivosVencidos',$data);
            } else{
                return $this->export('reportes.excel.ActivosVencidos',$data,'pdf');
            }
          }
          else{
            echo "<script>alert('No hay datos'); window.close();</script>";
          }
    }



    public function ActivosStock(){


        $sedes = Sede::all();
        $gerencias = Gerencia::all();
        $subgerencias = Subgerencia::all();

        return view('reportes.FrmActivosStock',compact('sedes','gerencias','subgerencias'));
        //return view('reportes.FrmActivosOperativos');

    }

    public function ActivosStockProcesar(Request $request){

          $sede         = $request->idsede_personal;
          $gerencia     = $request->idgerencia_personal;
          $subgerencia  = $request->idsubgerencia_personal;
          $exportar     = $request->exportar;

          $data = $this->getActivosStock();
          //dd($data);
          if(!empty($data)){
            if($exportar==1){
                $this->export('reportes.excel.ActivoStock',$data);
            } else{
                return $this->export('reportes.excel.ActivoStock',$data,'pdf');
            }
          }
          else{
            echo "<script>alert('No hay datos'); window.close();</script>";
          }
    }


    public function getActivosStock(){

        $sql = "select  
            (
             select tipo_hardwares.tipo_hardware from tipo_hardwares where id_tipo_hardware = h.idtipo_hardware
            ) tipo_hardware,

            (
             select tipo_softwares.tipo_software from tipo_softwares where id_tipo_software = s.idtipo_software
            ) tipo_software,
            h.fecha_adquisicion fa_hardware,
            s.fecha_adquisicion fa_software,
            s.nombre_software,
            s.arquitectura,
            s.service_pack,
            h.*
            from activos 
            left join hardwares h on h.id_activo_hardware = activos.idactivo
            left join softwares s on s.id_activo_software = activos.idactivo
            where activos.asignado!=1 or activos.asignado is null ";

        $sqlwhere = '';     

        return $activos = DB::select(DB::raw($sql.$sqlwhere));

    }

    public function ActivosPersonal(){

        $personals = Personal::all();
        //dd($personals);
        return view('reportes.frmActivosPersonal',compact('personals'));
    }

    public function ActivosPersonalProcesar(Request $request){

        $id         =  $request->personal;
        $exportar   =  $request->exportar;

        $data = $this->getActivosPersonal($id);
        //dd($data);

        if(!empty($data)){
        if($exportar==1){
            $this->export('reportes.excel.ActivosPersonal',$data);
        } else{
            return $this->export('reportes.excel.ActivosPersonal',$data,'pdf');
        }
        }
        else{
        echo "<script>alert('No hay datos'); window.close();</script>";
        }

    }


    public function getActivosPersonal($id=null){
        $sql = 'select 
            personals_idpersonal, `personals`.*, `activos`.*, `activos`.`updated_at` as `fecha_asignacion`, 
            (select gerencia from gerencias g where g.idgerencia=personals.idgerencia_personal ) as gerencia, 
            (select subgerencia from subgerencias sg where sg.idsubgerencia=personals.idsubgerencia_personal) subgerencia, 
            (select sede from sedes where sedes.idsede=personals.idsede_personal) sede, 
            (
            select concat("Tipo Software:", tipo_softwares.tipo_software," \n","Nombre: ",softwares.nombre_software,", Arquitectura: ",softwares.arquitectura,",\n Service Pack: ",softwares.service_pack) from softwares 
            join tipo_softwares on id_tipo_software=idtipo_software
            where softwares.id_activo_software=activos.idactivo
            ) software,
             (
             select concat("Tipo Hardware:", tipo_hardwares.tipo_hardware,"\n","Marca: ",hardwares.marca,", Modelo: ",hardwares.modelo,"\n Num. Serie: ",hardwares.num_serie,"\n Cod. Inventario: ",ifnull(hardwares.cod_inventario,"--")) 
             from hardwares 
             join tipo_hardwares on id_tipo_hardware = idtipo_hardware
             where hardwares.id_activo_hardware=activos.idactivo
            ) hardware,

            (
             select descripcion from hardwares 
             join tipo_hardwares on id_tipo_hardware = idtipo_hardware
             where hardwares.id_activo_hardware=activos.idactivo
            ) descripcion

             from (
             select activos_id, 
            (select personals_idpersonal from personals_activos b where a.activos_id=b.activos_id order by activos_id desc limit 1) personals_idpersonal
            from personals_activos a
            group by activos_id
            order by activos_id desc
             ) personals_activos
             left join `activos` on `personals_activos`.`activos_id` = `activos`.`idactivo` 
             left join `personals` on `personals_activos`.`personals_idpersonal` = `personals`.`idpersonal` 
             where activos.asignado=1 ';

        if(!empty($id) && $id ){
            $sql.= " and personals_activos.personals_idpersonal = ". $id;
        }     

        $activos = DB::select( DB::raw($sql));

 
        return $activos ;

    }

}
