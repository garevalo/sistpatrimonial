@extends('back.app')

@section('title')Módulo de Software @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-users"></i>  Listado de Activos Software &nbsp;&nbsp;
        <a href="{{route('software.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Nuevo Software
        </a>

    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Software</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo Software</th>
                        <th>Nombre</th>
                        <th>Arquitectura</th>
                        <th>Service Pack</th>
                        <th>Fecha Adquisición</th>
                        <th>Editar</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($softwares as $software)
                        <tr>
                            <td>{{$software->idsoftware}}</td>
                            <td>{{$software->nombre_software}}</td>
                            <td>{{$software->tiposoftware->tipo_software}}</td>
                            <td>{{$software->arquitectura}}</td>
                            <td>{{$software->service_pack}}</td>
                            <td>{{$software->fecha_adquisicion->format('d-m-Y')}}</td>
                            <td><a href="{{route('software.edit',$software->idsoftware)}}" class="btn btn-primary btn-sm">Editar</a></td>
                        </tr>
                    @endforeach

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
        $(function () {
            $("#example1").DataTable({
                order: [[0, 'desc']],
                "language": {
                    "url": "{{asset("plugins/datatables/Spanish.json")}}"
                }
            });
        });
    </script>

@endsection