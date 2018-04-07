@extends('back.app')

@section('title')Módulo de Asignación @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">

@endsection
@section('menu-h1')
    <h1>
        <i class="fa fa-microchip"></i>  Módulo de Asignación &nbsp;&nbsp;

        <a href="{{route('hardware.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Hardware
        </a>

        <a href="{{route('software.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Sofware
        </a>
        <a href="{{route('activo.index')}}" class="btn btn-sm btn-primary" title="Asignar Activos">
            <i class="fa  fa-reply"></i> Regresar
        </a>
    </h1>
@endsection

@section('content')

    <div class="col-xs-12">
        <div class="box">

            <!-- /.box-header -->
            <div class="box-body">
                <form action="{{route("activo.store")}}" class="form-group" method="post">
                    <div class="col-md-11 col-xs-12">
                        {{csrf_field()  }}
                        <div class="form-group">
                            <label>Seleccione Personal</label>
                            <select class="input-sm form-control select2" name="personal" required="">
                                <option value="">Seleccione Personal</option>
                                @foreach($personals as $personal)
                                    <option value="{{$personal->idpersonal}}">{{$personal->nombres.' '.$personal->apellido_paterno.' '.$personal->apellido_materno }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="box box-primary">
                            <div class="box-header">
                                <h3 class="box-title">Activos</h3>
                            </div>
                            <div class="box-body">
                                <table id="table-activos" class="table table-condensed table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>Tipo Activo</th>
                                        <th>SOftware/Marca</th>
                                        <th>Arquitecura / Modelo</th>
                                        <th>Service Pack / Num. Serie</th>
                                        <th>C.Inventario</th>
                                        <th>C.Patrimonial</th>
                                        <th>Descripción</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>

                            </div>
                        </div>   
                    </div>
                    <div class="col-md-1 col-xs-12">
                        <button type="submit" class="btn btn-warning btn-block"> <i class="fa fa-send-o"></i> <br>Asignar</button>    
                    </div>
                    
                </form>

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
            ajax: '{{route('getdataactivo')}}',
            columns: [
                {
                    data:'idactivo',
                    render: function(data, type, row){

                            return '<input type="checkbox" id="inputUnchecked" name="activo[]" value="'+data+'"/>';
                    },
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
                {data: 'descripcion_hardware', name: 'descripcion_hardware'}
            ],
            order: [[0, 'desc']],
            "language": {
                "url": "{{asset("plugins/datatables/Spanish.json")}}"
            }
        });
    </script>

@endsection