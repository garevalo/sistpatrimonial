@extends('back.app')

@section('title','Registrar '. ucwords($modulo))

@section('content')

<div class="col-xs-12">

    <div class="box box-danger">
        <div class="box-header">
            <h3 class="box-title">Registrar {{ucwords($modulo)}}</h3>
        </div>


        <form method="POST" action="{{route($modulo.'.store')}}">

            {{csrf_field()}}
            <div class="box-body">
                {{ Form::selectfield('cod_grupo_generico','Grupo Genérico',$grupos,'Seleccione Grupo') }}

                {{ Form::selectfield('cod_clase_generico','Clase Genérico',$clases,'Seleccione Clase') }}

                <div class="form-group-sm  {{ $errors->has('codcatalogo') ? ' has-error' : '' }}">
                    <label>Código:</label>

                    <input type="text" class="form-control" name="codcatalogo" id="codcatalogo" value="{{old('codcatalogo')}}" required autofocus>
                    {!! $errors->first('codcatalogo','<span class="help-block">:message</span>') !!}
                </div>

                <div class="form-group-sm  {{ $errors->has('denom_catalogo') ? ' has-error' : '' }}">
                    <label>Denominación:</label>

                    <input type="text" class="form-control" name="denom_catalogo" id="denom_catalogo" value="{{old('denom_catalogo')}}" required>
                    {!! $errors->first('denom_catalogo','<span class="help-block">:message</span>') !!}
                </div>


                <div class="form-group-sm  {{ $errors->has('idestado') ? ' has-error' : '' }}">
                    <label>Estado:</label>
                    <select class="form-control" name="idestado" id="idestado" required="">
                        <option value="">Seleccione estado</option>
                        @foreach($estados as $key => $estado)
                        <option value="{{$key}}" @if($key==old('idestado')) selected @endif >{{$estado}}</option>
                        @endforeach
                    </select>
                    {!! $errors->first('idestado','<span class="help-block">:message</span>') !!}
                </div>

            </div>


            <div class="box-footer">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
        <!-- /.box-body -->
    </div>

</div>

@endsection

@section('javascript')
    @parent()

    <script type="text/javascript">

        function getData(){
          $.ajax({
            type: "GET",
            url: '{{ route() }}', 
            dataType: "json",
            success: function(data){
              $.each(data,function(key, registro) {
                $("#cod_clase_generico").append('<option value='+registro.id+'>'+registro.nombre+'</option>');
              });        
            },
            error: function(data) {
              alert('error');
            }
          });
        }

        $("#cod_clase_generico").post

        $( "#cod_clase_generico" ).change(function() {
            $("#codcatalogo").val( $("#cod_grupo_generico").val() + $("#cod_clase_generico").val()  );  
        });

        $( "#cod_grupo_generico" ).change(function() {
            $("#codcatalogo").val( $("#cod_grupo_generico").val() + $("#cod_clase_generico").val()  );  
        });
    </script>

@endsection