@extends('back.app')

@section('title')Módulo de Hardware @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-microchip"></i>  Listado de Bienes &nbsp;&nbsp;
        <a href="{{route('bien.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Bien
        </a>

    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bienes</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-condensed table-bordered table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Catálogo</th>
                        <th>Cod. Inventario</th>
                        <th>Código Patrimonial</th>
                        <th>color</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Imagen</th>
                        <th>Centro Costo</th>
                        <th>Responsable</th>
                        <th></th>
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

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('getbienes')}}',
            columns: [
                {data: 'idbien', name: 'idbien'},
                {data: 'catalogo', name: 'catalogo'},
                {data: 'codinventario', name: 'codinventario'},
                {data: 'codpatrimonial', name: 'codpatrimonial'},
                {data: 'color', name: 'color'},
                {data: 'marca', name: 'marca'},
                {data: 'modelo', name: 'modelo'},
                {data:'foto',name:'foto'},
                {data:'centrocosto',name:'centrocosto'},
                {data:'responsable',name:'responsable'},
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