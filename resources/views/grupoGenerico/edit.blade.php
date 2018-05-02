@extends('back.app')

@section('title','Editar '. ucwords($titulomod) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{ucwords($titulomod)}}</h3>
            </div>


            {{ Form::model($table, ['action' => ['GrupoGenericoController@update',$table->idgrupogenerico],'method'=>'put']) }}
            <div class="box-body">

                {{ Form::textfield('cod_grupo_generico','Cod. Grupo Genérico',$table->cod_grupo_generico ) }}

                {{ Form::textfield('grupo_generico','Grupo Genérico', $table->grupo_generico) }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
        </div>

    </div>

@endsection