@extends('back.app')

@section('title','Registrar '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['action' => 'CentroCostoController@store']) !!}
            <div class="box-body">

                {{ Form::selectfield('idgerencia','Gerencia',$gerencias,'Seleccione Gerencias') }}

                {{ Form::selectfield('idsubgerencia','Sub Gerencia',$subgerencias,'Seleccione Subgerencias') }}

                {{ Form::selectfield('idlocal','Local',$locales,'Seleccione Locales') }}

                {{ Form::selectfield('idpersonal','Personal',$personales,'Seleccione Personal') }}

                {{ Form::textfield('codcentrocosto','Cod. Centro Costo') }}

                {{ Form::textfield('centrocosto','Centro Costo') }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
    </div>

</div>

@endsection