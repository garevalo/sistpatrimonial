@extends('back.app')

@section('title','Editar '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['action' => ['InventarioController@update',$table->idinventario],'method'=>'put'] ) !!}
        
            <div class="box-body">

                {{ Form::selectfield('idpersonal','Usuario a programar inventario',$personals,'Seleccione Usuario',$table->id) }}

                {{Form::textfield('fecha_desde','Fecha',$table->fecha_desde->format('d/m/Y'),["data-inputmask" => "'alias': 'dd/mm/yyyy'" ,"data-mask"=>"" ])}} 

                {{-- Form::textfield('fecha_hasta','Fecha hasta','',["data-inputmask" => "'alias': 'dd/mm/yyyy'" ,"data-mask"=>"" ]) --}}

                {{ Form::selectfield('centrocosto','Centro de Costo',$centrocostos,'Seleccione Centro Costo',$table->centrocosto) }} 

                {{ Form::selectfield('estado','Estado',$estados,'Seleccione Estado',$table->estado) }}
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
    </div>

</div>

@endsection


@section('javascript')

@parent

<!-- InputMask -->
<script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>

<script>
    $(function () {
        
        $("[data-mask]").inputmask();
    });
</script>

@endsection