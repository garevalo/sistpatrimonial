@extends('back.app')

@section('title') Seguimiento de Activos @endsection

@section('head')
    @parent
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
@endsection

@section('menu-h1')
    <h1>
        <i class="fa fa-microchip"></i>  Seguimiento de Activos &nbsp;&nbsp;

        <a href="{{route('hardware.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Hardware
        </a>

        <a href="{{route('software.create')}}" class="btn btn-sm btn-success" title="Add Data">
            <i class="fa fa-plus-circle"></i> Registrar Sofware
        </a>
        <a href="{{route('activo.seguimiento')}}" class="btn btn-sm btn-primary" title="Asignar Activos">
            <i class="fa  fa-reply"></i>  Regresar
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
                <table id="table-activos" class="table table-condensed table-bordered">
                    <thead>
                    <tr>
                        <th>Personal</th>
                        <th>Sede</th>
                        <th>Gerencia</th>
                        <th>Subgerencia</th>
                        <th>Fecha Asignación</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    	@foreach($activos as $key => $activo)
                    	<tr>
                    		<td>{{$activo->nombres.' '.$activo->apellido_paterno.' '.$activo->apellido_materno}}</td>
                    		<td>{{$activo->sede}}</td>
                    		<td>{{$activo->gerencia}}</td>
                    		<td>{{$activo->subgerencia}}</td>
                    		<td>{{$activo->fecha_asignacion}}</td>
                    		<td> @if($key==0) <label class="label label-info">Ubicación Actual</label>  @endif</td>
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

