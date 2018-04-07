@extends('back.app')

@section('title')Módulo de Hardware @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-microchip"></i>  Listado de Activos Hardware &nbsp;&nbsp;
        <a href="{{route('hardware.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Nuevo Hardware
        </a>

    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Hardware</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-hardware" class="table table-condensed table-bordered table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo Hardware</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Num.Serie</th>
                        <th>Cod. Inventario</th>
                        <th>Orden Compra</th>
                        <th>Código Patrimonial</th>
                        <th width="20%">Descripción</th>
                        <th>Fec. Adquision</th>
                        <th>Estado</th>
                        <th>Estado Activo</th>
                        <th>Editar</th>
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
       
         var table = $('#table-hardware').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('getalldatahardware')}}',
            columns: [

                {data: 'idhardware', name: 'idhardware'},
                {data: 'tipohardware.tipo_hardware', name: 'tipo_hardware'},
                {data: 'marca', name: 'marca'},
                {data: 'modelo', name: 'modelo'},
                {data: 'num_serie',name:'num_serie'},
                {data: 'cod_inventario', name: 'cod_inventario'},
                {data: 'activo.orden_compra', name: 'orden_compra'},
                {data: 'codigo_patrimonial', name: 'codigo_patrimonial'},
                {data: 'descripcion', name: 'descripcion'},
                {data: 'fecha_adquisicion', name: 'fecha_adquisicion'},
                {data: 'estadohardware', name: 'estadohardware'},
                {data: 'estadoactivo', name: 'estadoactivo'},
                {data: 'edit', name: 'edit'}

            ],
            order: [[0, 'desc']],
            "language": {
                "url": "{{asset("plugins/datatables/Spanish.json")}}"
            }
        });
    </script>

@endsection