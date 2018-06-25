@extends('back.app')

@section('title')Módulo de Transferencia @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-microchip"></i>  Listado de Transferencias &nbsp;&nbsp;
        <a href="{{route('bien.transferencia')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Transferencia
        </a>

    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Transferencias</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table" class="table table-condensed table-bordered table-responsive table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>CC. Origen</th>
                        <th>Personal Origen</th>
                        <th>CC. Destino</th>
                        <th>Personal Destino</th>
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
 @parent()

 	<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
 	<script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>>
    <script>
        //var template = Handlebars.compile($("#details-template").html());

        var table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('gettransferencia')}}',
            columns: [
                {data: 'idtransferencia', name: 'idtransferencia'},
                {data: 'ccorigen', name: 'ccorigen'},
                {data: 'personalorigen', name: 'personalorigen'},
                {data: 'ccdestino', name: 'ccdestino'},
                {data: 'personaldestino', name: 'personaldestino'},
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