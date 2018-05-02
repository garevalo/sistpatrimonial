@extends('back.app')

@section('title','Registrar '. ucwords($titulomod))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar {{ucwords($titulomod)}}</h3>
        </div>
        {!! Form::model($table, ['action' => 'ClaseGenericoController@store']) !!}
            <div class="box-body">

                {{ Form::selectfield('cod_grupo_generico','Grupo Genérico',$grupos,'Seleccione Grupo') }}

                {{ Form::textfield('cod_clase_generico','Cod. Clase Genérico') }}

                {{ Form::textfield('clase_generico','Clase Genérico') }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
    </div>

</div>

@endsection