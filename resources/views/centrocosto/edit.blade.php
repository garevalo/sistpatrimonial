@extends('back.app')

@section('title','Editar '. ucwords($titulomod) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{ucwords($titulomod)}}</h3>
            </div>

        {!! Form::model($table, ['action' => ['CentroCostoController@update',$table->id],'method'=>'put'] ) !!}
            <div class="box-body">

                {{ Form::selectfield('idgerencia','Gerencia',$gerencias,'Seleccione Gerencias',$table->idgerencia) }}

                {{ Form::selectfield('idsubgerencia','Sub Gerencia',$subgerencias,'Seleccione Subgerencias',$table->idsubgerencia) }}

                {{ Form::selectfield('idlocal','Local',$locales,'Seleccione Locales',$table->idlocal) }}

                {{ Form::selectfield('idpersonal','Personal',$personales,'Seleccione Personal',$table->idpersonal) }}

                {{ Form::textfield('centrocosto','Cod. Centro Costo',$table->centrocosto) }}

                {{ Form::textfield('codcentrocosto','Centro Costo',$table->codcentrocosto) }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
        </div>

    </div>

@endsection