@extends('back.app')

@section('title','Ver '. ucwords($titulomod) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Realizar inventario {{ucwords($titulomod)}}</h3>
            </div>
            
            {{ Form::model($table, ['route' => ['inventario.fisico',$table->idinventario]]) }}
            <input type="hidden" name="idinventario" value="{{$table->idinventario}}">
            <input type="hidden" name="idpersonal" value="{{$table->idpersonal}}">
            <input type="hidden" name="centrocosto" value="{{$table->centrocosto}}">

            <div class="box-body">            	
            	<table class="table table-condensed table-striped">
            		<thead>
            			<th>C. Catálogo</th>
            			<th>C. Inventario</th>
            			<th>C. Patrimonial</th>
            			<th>Situación</th>
            		</thead>
            		@foreach($centrocosto->bien as $bien)
            		<tr>
            			<td><input type="hidden" name="idbien[]" value="{{$bien->idbien}}"> {{ $bien->codcatalogo}} </td>
            			<td>{{ $bien->codinventario}}</td>
            			<td>{{ $bien->codpatrimonial}}</td>
            			<td>{{ Form::select('situacion[]',$situacion,'',['placeholder'=> 'Seleccione Situación','class'=>'form-control input-sm']) }}</td>
            		</tr>
            		@endforeach
            	</table>
              
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
        </div>

    </div>

@endsection