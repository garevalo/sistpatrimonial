@extends('back.app')

@section('title','Registrar Bien')

@section('content')

    <div class="col-xs-12">

        <div class="box box-danger">
            <div class="box-header">
                <h3 class="box-title">Registrar Bien</h3>
            </div>

            <form method="POST" action="{{route('bien.store')}}">
                {{csrf_field()}}
                <div class="box-body">

                    <div class="form-group-sm {{ $errors->has('cod_inventario') ? ' has-error' : '' }}">
                        <label>Código Inventario:</label>

                        <input type="text" class="form-control" name="cod_inventario" id="cod_inventario" value="{{old('cod_inventario')}}">
                        {!! $errors->first('cod_inventario','<span class="help-block">:message</span>') !!}
                    </div>
                     <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                        <label>Código Patrimonial:</label>

                        <input type="text" class="form-control" name="codigo_patrimonial" id="codigo_patrimonial" value="{{old('codigo_patrimonial')}}">
                        {!! $errors->first('codigo_patrimonial','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('marca') ? ' has-error' : '' }}">
                        <label>Marca:</label>

                        <input type="text" class="form-control" name="marca" id="marca" value="{{old('marca')}}" required>
                        {!! $errors->first('marca','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('modelo') ? ' has-error' : '' }}">
                        <label>Modelo:</label>

                        <input type="text" class="form-control" name="modelo" id="modelo" value="{{old('modelo')}}" required>
                        {!! $errors->first('modelo','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('num_serie') ? ' has-error' : '' }}">
                        <label>Número Serie:</label>

                        <input type="text" class="form-control" name="num_serie" id="num_serie" value="{{old('num_serie')}}">
                        {!! $errors->first('num_serie','<span class="help-block">:message</span>') !!}
                    </div>
                    
                    <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                        <label>Orden de Compra:</label>

                        <input type="text" class="form-control" name="orden_compra" id="orden_compra" value="{{old('orden_compra')}}" required>
                        {!! $errors->first('orden_compra','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('estado') ? ' has-error' : '' }}">
                        <label>Estado:</label>

                        <select name="estado" id="estado" class="form-control">
                            <option value="">Estado</option>
                           
                        </select>
                        {!! $errors->first('estado','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                        <label>Valor:</label>

                        <input type="text" class="form-control" name="orden_compra" id="orden_compra" value="{{old('orden_compra')}}" required>
                        {!! $errors->first('orden_compra','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('orden_compra') ? ' has-error' : '' }}">
                        <label>Modo de Adquisición:</label>

                        <input type="text" class="form-control" name="orden_compra" id="orden_compra" value="{{old('orden_compra')}}" required>
                        {!! $errors->first('orden_compra','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('fecha_adquisicion') ? ' has-error' : '' }}">
                        <label>Fecha de Adquisición:</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="" name="fecha_adquisicion" id="fecha_adquisicion">
                        </div>
                        {!! $errors->first('fecha_adquisicion','<span class="help-block">:message</span>') !!}
                    </div>
                    {{--
                    <div class="form-group-sm {{ $errors->has('capacidad') ? ' has-error' : '' }}">
                        <label>Capacidad:</label>

                        <input type="text" class="form-control" name="capacidad" id="capacidad" value="{{old('capacidad')}}">
                        {!! $errors->first('capacidad','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group-sm {{ $errors->has('interfaz') ? ' has-error' : '' }}">
                        <label>Interfaz:</label>

                        <input type="text" class="form-control" name="interfaz" id="interfaz" value="{{old('interfaz')}}" >
                        {!! $errors->first('interfaz','<span class="help-block">:message</span>') !!}
                    </div>

                    <div class="form-group-sm {{ $errors->has('tipo') ? ' has-error' : '' }}">
                        <label>Tipo Componente:</label>

                        <input type="text" class="form-control" name="tipo" id="tipo" value="{{old('tipo')}}" >
                        {!! $errors->first('tipo','<span class="help-block">:message</span>') !!}
                    </div> --}}
                    <div class="form-group-sm {{ $errors->has('descripcion') ? ' has-error' : '' }}">
                        <label>Descripción:</label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="10" class="form-control" required >{{old('descripcion')}}</textarea>
                        {!! $errors->first('descripcion','<span class="help-block">:message</span>') !!}
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