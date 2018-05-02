@extends('back.app')

@section('title','Editar '. ucwords($titulomod) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{ucwords($titulomod)}}</h3>
            </div>

        {!! Form::model($table, ['action' => ['ClaseGenericoController@update',$table->idclasegenerico],'method'=>'put'] ) !!}
            <div class="box-body">

                {{ Form::selectfield('cod_grupo_generico','Grupo Genérico',$grupos,'Seleccione Grupo',$table->cod_grupo_generico) }}

                {{ Form::textfield('cod_clase_generico','Cod. Clase Genérico',$table->cod_clase_generico) }}

                {{ Form::textfield('clase_generico','Clase Genérico',$table->clase_generico) }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
        </div>

    </div>

@endsection