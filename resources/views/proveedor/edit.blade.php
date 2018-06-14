@extends('back.app')

@section('title','Editar '. ucwords($titulomod) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar {{ucwords($titulomod)}}</h3>
            </div>


            {{ Form::model($table, ['action' => ['ProveedorController@update',$table->idproveedor],'method'=>'put']) }}
            <div class="box-body">

                {{ Form::textfield('razon_social','Razón Social',$table->razon_social) }}

                {{ Form::textfield('ruc','RUC',$table->ruc) }}
                
                {{ Form::textfield('telefono','Teléfono',$table->telefono) }}

                {{ Form::textfield('direccion','Dirección',$table->direccion) }}
               
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
        </div>

    </div>

@endsection