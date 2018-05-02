@extends('back.app')

@section('title','Registrar '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['action' => 'ProveedorController@store']) !!}
            <div class="box-body">

                {{ Form::textfield('razon_social','Razón Social') }}

                {{ Form::textfield('telefono','Teléfono') }}

                {{ Form::textfield('ruc','RUC') }}

                {{ Form::textfield('direccion','Dirección') }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
    </div>

</div>

@endsection