@extends('back.app')

@section('title','Editar Hardware')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Editar Hardware</h3>
            </div>

            <form method="POST" action="{{route('hardware.update',$hardware->idhardware)}}">

                {{csrf_field()}}
                {!! method_field('PUT') !!}

                <div class="box-body">

                    <div class="form-group-sm {{ $errors->has('idtipo_hardware') ? ' has-error' : '' }}">
                        <label>Tipo:</label>
                        <select name="idtipo_hardware" id="idtipo_hardware" class="form-control" required>
                            <option value="">Seleccione</option>
                            @foreach($tipohardwares as $tipohardware)
                                <option value="{{$tipohardware->id_tipo_hardware}}" @if($hardware->idtipo_hardware==$tipohardware->id_tipo_hardware) selected @endif>{{$tipohardware->tipo_hardware}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('idtipo_hardware','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('cod_inventario') ? ' has-error' : '' }}">
                        <label>Código Inventario:</label>

                        <input type="text" class="form-control" name="cod_inventario" id="cod_inventario" value="{{$hardware->cod_inventario}}">
                        {!! $errors->first('cod_inventario','<span class="help-block">:message</span>') !!}
                    </div>
                     <div class="form-group-sm {{ $errors->has('codigo_patrimonial') ? ' has-error' : '' }}">
                        <label>Código Patrimonial:</label>

                        <input type="text" class="form-control" name="codigo_patrimonial" id="codigo_patrimonial" value="{{ $hardware->codigo_patrimonial }}">
                        {!! $errors->first('codigo_patrimonial','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('marca') ? ' has-error' : '' }}">
                        <label>Marca:</label>

                        <input type="text" class="form-control" name="marca" id="marca" value="{{ $hardware->marca  }}" required>
                        {!! $errors->first('marca','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('modelo') ? ' has-error' : '' }}">
                        <label>Modelo:</label>

                        <input type="text" class="form-control" name="modelo" id="modelo" value="{{$hardware->modelo}}" required>
                        {!! $errors->first('modelo','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('num_serie') ? ' has-error' : '' }}">
                        <label>Número Serie:</label>

                        <input type="text" class="form-control" name="num_serie" id="num_serie" value="{{ $hardware->num_serie  }}">
                        {!! $errors->first('num_serie','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                        <label>Orden de Compra:</label>

                        <input type="text" class="form-control" name="orden_compra" id="orden_compra" value="{{ $hardware->activo->orden_compra }}" required>
                        {!! $errors->first('orden_compra','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('estado_activo') ? ' has-error' : '' }}">
                        <label>Estado del Activo:</label>

                        <select name="estado_activo" id="estado_activo" class="form-control">
                            <option value="">Estado del Activo</option>
                            @foreach($estados_activos as $key => $estado_activo)
                                <option value="{{$key}}" @if($key == $hardware->activo->estado_activo ) selected @endif >{{$estado_activo}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('estado_activo','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('estado') ? ' has-error' : '' }}">
                        <label>Estado:</label>

                        <select name="estado" id="estado" class="form-control">
                            <option value="">Estado</option>
                            @foreach($estados as $key => $estado)
                                <option value="{{$key}}" @if($key==$hardware->estado ) selected @endif >{{$estado}}</option>
                            @endforeach
                        </select>
                        {!! $errors->first('estado','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('fecha_adquisicion') ? ' has-error' : '' }}">
                        <label>Fecha de Adquisición:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="fecha_adquisicion" id="fecha_adquisicion" value="{{$hardware->fecha_adquisicion->format('d/m/Y')}}">
                        </div>
                    {!! $errors->first('fecha_adquisicion','<span class="help-block">:message</span>') !!}
                    <!-- /.input group -->
                    </div>
                    {{-- dfdfd f
                    <div class="form-group-sm {{ $errors->has('capacidad') ? ' has-error' : '' }}">
                        <label>Capacidad:</label>

                        <input type="text" class="form-control" name="capacidad" id="capacidad" value="{{$hardware->capacidad}}">
                        {!! $errors->first('capacidad','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('interfaz') ? ' has-error' : '' }}">
                        <label>Interfaz:</label>

                        <input type="text" class="form-control" name="interfaz" id="interfaz" value="{{$hardware->interfaz}}" >
                        {!! $errors->first('interfaz','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('tipo') ? ' has-error' : '' }}">
                        <label>Tipo Componente:</label>

                        <input type="text" class="form-control" name="tipo" id="tipo" value="{{$hardware->tipo}}" >
                        {!! $errors->first('tipo','<span class="help-block">:message</span>') !!}
                    </div>
                    --}}
                    <div class="form-group-sm {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                        <label>Descripción:</label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" required >{{$hardware->descripcion }}</textarea>
                        {!! $errors->first('descripcion','<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" value="{{$hardware->id_activo_hardware}}" name="idactivo">

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

    <!-- InputMask -->
    <script src="{{asset('plugins/input-mask/jquery.inputmask.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
    <script src="{{asset('plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>

    <link rel="stylesheet" href="{{asset('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

    <script>
        $(function () {
            //Datemask dd/mm/yyyy
            $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
            //Datemask2 mm/dd/yyyy
            $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
            //Money Euro
            $("[data-mask]").inputmask();
        });
    </script>

@endsection