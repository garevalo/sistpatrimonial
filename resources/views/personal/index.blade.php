@extends('back.app')

@section('title')Módulo de {{$modulo}} @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-users"></i>  {{$modulo}} &nbsp;&nbsp;

        <a href="{{route('personal.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Agregar {{$modulo}}
        </a>

    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{$modulo}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Dni</th>
                        <th>Cargo</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($personals as $personal)
                        <tr>
                            <td>{{$personal->idpersonal}}</td>
                            <td>{{$personal->nombres}}</td>
                            <td>{{$personal->apellido_paterno .' '.$personal->apellido_materno  }}</td>
                            <td>{{ str_pad($personal->dni, 8, "0", STR_PAD_LEFT)  }}</td>
                            <td>{{$personal->cargo->cargo}}</td>
                            <td><a href="{{route('personal.edit',$personal->idpersonal)}}" class="btn btn-primary btn-xs">Editar</a></td>
                            <td>
                                <form method="post" action="{{ route('personal.destroy',$personal->idpersonal) }}">
                                    {!! csrf_field() !!}
                                    {!! method_field('DELETE') !!}
                                    <input type="submit" value="Eliminar" class="btn btn-danger btn-xs">
                                </form>
                            </td>
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