@extends('back.app')

@section('title')Módulo de {{ucwords($titulomod)}} @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-cogs"></i> Lista de {{ucwords($titulomod)}} &nbsp;&nbsp;
        <a href="{{route($modulo.'.create')}}" class="btn btn-sm btn-success" title="nuevo">
            <i class="fa fa-plus-circle"></i> Nuevo {{ucwords($titulomod)}}
        </a>

    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{ucwords($titulomod)}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-bordered table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>Código</th>
                        <th>Centro de Costo</th>
                        <th>Gerencia</th>
                        <th>Sub Gerencia</th>
                        <th>Local</th>
                        <th>Personal</th>
                        <th>Editar</th>

                    </tr>
                    </thead>
                    <tbody></tbody>
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

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('getcentrocostos')}}',
            columns: [
                {data: 'codcentrocosto', name: 'codcentrocosto'},
                {data: 'centrocosto', name: 'centrocosto'},
                {data: 'idgerencia', name: 'idgerencia'},
                {data: 'idsubgerencia', name: 'idsubgerencia'},
                {data: 'idlocal', name: 'idlocal'},
                {data: 'idpersonal', name: 'idpersonal'},
                {
                    data: 'edit',
                    name: 'edit',
                    orderable:false,
                    searchable:false
                },
            ],
            order: [[0, 'desc']],
            "language": {
                "url": "{{asset("plugins/datatables/Spanish.json")}}"
            }
        });
    </script>

@endsection