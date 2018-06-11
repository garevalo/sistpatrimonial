@extends('back.app')

@section('title','Editar '. ucwords($titulomod) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{ucwords($titulomod)}}</h3>
            </div>


            {{ Form::model($table, ['action' => ['OficinaController@update',$table->idoficina],'method'=>'put']) }}
            <div class="box-body">

                {{ Form::textfield('oficina','Oficina',$table->oficina) }}
                {{ Form::selectfield('idlocal','Local',$locales,'Seleccione Local',$table->idlocal) }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
        </div>

    </div>

@endsection