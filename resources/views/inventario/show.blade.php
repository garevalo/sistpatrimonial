@extends('back.app')

@section('title','Ver '. ucwords($titulomod) )

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Realizar {{ucwords($titulomod)}}</h3>
            </div>

            {{ Form::model($table, ['route' => ['inventario.fisico',$table->idinventario]]) }}
            <input type="hidden" name="idinventario" value="{{$table->idinventario}}">

            <div class="box-body">            	
            	<table class="table table-condensed table-striped">
            		<thead>
                        <th>Bien</th>
            			<th>C. Catálogo</th>
            			<th>C. Inventario</th>
            			<th>C. Patrimonial</th>
            			<th>Situación</th>
            		</thead>

                    @if(count($bienes)>0)
                        @foreach($bienes as $bien)
                         @if($bien->idbaja== 1 or $bien->idbaja=='') 
                        <tr>
                            <td>{{$bien->catalogo->denom_catalogo}}</td>
                            <td>
                                <input type="hidden" name="idbien[]" value="{{$bien->idbien}}">
                                <input type="hidden" name="codcatalogo[]" value="{{$bien->codcatalogo}}">
                                <input type="hidden" name="codinventario[]" value="{{$bien->codinventario}}">
                                <input type="hidden" name="codpatrimonial[]" value="{{$bien->codpatrimonial}}"> 
                                {{ $bien->codcatalogo}} 
                            </td>
                            <td>{{ $bien->codinventario}}</td>
                            <td>{{ $bien->codpatrimonial}}</td>
                            <td>{{ Form::select('situacion[]',$situacion,$bien->situacion,['placeholder'=> 'Seleccione Situación','class'=>'form-control input-sm']) }}</td>
                        </tr>
                        @endif
                        @endforeach
                    @else
                        @foreach($centrocosto->bien as $bien)
                        @if($bien->idbaja== 1 or $bien->idbaja=='')
                        <tr>
                            <td>{{ $bien->catalogo->denom_catalogo  }}</td>
                            <td>
                                <input type="hidden" name="idbien[]" value="{{$bien->idbien}}">
                                <input type="hidden" name="codcatalogo[]" value="{{$bien->codcatalogo}}">
                                <input type="hidden" name="codinventario[]" value="{{$bien->codinventario}}">
                                <input type="hidden" name="codpatrimonial[]" value="{{$bien->codpatrimonial}}"> 
                                {{ $bien->codcatalogo}} 
                            </td>
                            <td>{{ $bien->codinventario}}</td>
                            <td>{{ $bien->codpatrimonial}}</td>
                            <td>{{ Form::select('situacion[]',$situacion,'',['placeholder'=> 'Seleccione Situación','class'=>'form-control input-sm']) }}</td>
                        </tr>
                        @endif
                        @endforeach
                    @endif

            		
            	</table>
              
            </div>  
            <div class="box-footer">
                <button class="btn btn-sm btn-primary" type="submit">Guardar</button>
            </div>
        {!! Form::close() !!}  
        </div>

    </div>

@endsection
