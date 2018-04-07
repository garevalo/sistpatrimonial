@extends('back.app')

@section('title')Módulo de Asignación @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-microchip"></i>  Asignación &nbsp;&nbsp;

        <a href="{{route('hardware.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Hardware
        </a>

        <a href="{{route('software.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Sofware
        </a>
        <a href="{{route('asignar')}}" class="btn btn-sm btn-primary" title="Asignar Activos">
            <i class="fa fa-plus-circle"></i> Asignar Activos
        </a>
    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Activos</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-activos" class="table table-condensed table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">ID</th>
                        <th width="5%">Tipo Activo</th>
                        <th width="20%">Activo</th>
                        <th width="10%">Personal</th>
                        <th width="5%">Sede</th>
                        <th width="5%">Gerencia</th>
                        <th width="5%">Sub Gerencia</th>
                        <th width="5%">Fecha Adquision </th> 
                        <th width="5%">Fecha Asignación</th>
                        <th width="15%">Descripción</th>
                        <th width="5%">Estado Activo</th>
                        <th width="5%">Estado Hardware</th>
                        <th width="5%">Reasignar</th>
                        <th width="5%">Editar</th>
                        
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>

@endsection

@section('javascript')
    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- page script -->

    <script>
        //var template = Handlebars.compile($("#details-template").html());

        var table = $('#table-activos').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('allgetdataactivo')}}',
            columns: [

                {data: 'idactivo', name: 'idactivo'},
                {data: 'nombre_tipo_activo', name: 'nombre_tipo_activo'},
                {data: 'tipo_activo', name: 'tipo_activo'},
                {data: 'nombres_personal', name: 'nombres_personal'},
                {data: 'sede',name:'sede'},
                {data: 'gerencia', name: 'gerencia'},
                {data: 'subgerencia', name: 'subgerencia'},
                {data: 'fechaadquision', name: 'fechaadquision'},
                {data: 'fechaasignacion', name: 'fechaasignacion'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'estado_activo', name: 'estado_activo'},
                {data: 'estado_hardware', name: 'estado_hardware'},
                {data: 'reasignar', name: 'reasignar'},
                {data: 'edit', name: 'edit'}

            ],
            order: [[0, 'desc']],
            "language": {
                "url": "{{asset("plugins/datatables/Spanish.json")}}"
            }
        });
    </script>

@endsection