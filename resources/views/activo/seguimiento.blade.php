@extends('back.app')

@section('title')Módulo de Seguimiento @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">

@endsection
@section('menu-h1')
    <h1>
        <i class="fa fa-laptop"></i>  Módulo de Seguimiento &nbsp;&nbsp;

        <a href="{{route('hardware.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Hardware
        </a>

        <a href="{{route('software.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Sofware
        </a>
    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
                   
                        {{csrf_field()  }}
                       
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Activos</h3>
                            </div>
                            <div class="box-body">
                                <table id="table-activos" class="table table-condensed table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Activo</th>
                                        <th>Tipo Activo</th>
                                        <th>SOftware/Marca</th>
                                        <th>Arquitecura / Modelo</th>
                                        <th>Service Pack / Num. Serie</th>
                                        <th>C.Inventario</th>
                                        <th>C.Patrimonial</th>
                                        <th>Seguimiento</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>   

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </div>

@endsection

@section('javascript')
    @parent()

    <!-- Select2 -->
    <script src="{{asset('plugins/select2/select2.full.js')}}"></script>
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script>
        $(function(){
            //Initialize Select2 Elements
            $('.select2').select2();
        });
    </script>

    <script>
        //var template = Handlebars.compile($("#details-template").html());

        var table = $('#table-activos').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('getdataseguimiento')}}',
            columns: [
                {
                    data:'idactivo',
                    name:'idactivo',
                    orderable:false,
                    searchable:false
                },
                {data: 'tipoactivo', name: 'tipoactivo'},
                {data: 'campo4', name: 'campo4'},
                {data: 'campo1', name: 'campo1'},
                {data: 'campo2', name: 'campo2'},
                {data: 'campo3', name: 'campo3'},
                {data: 'cod_inventario', name: 'cod_inventario'},
                {data: 'codigo_patrimonial', name: 'codigo_patrimonial'},
                {data: 'seguimiento', name: 'seguimiento'}
            ],
            order: [[0, 'desc']],
            "language": {
                "url": "{{asset("plugins/datatables/Spanish.json")}}"
            }
        });
    </script>

@endsection